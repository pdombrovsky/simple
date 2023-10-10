<?php

declare(strict_types=1);

require_once '../config.php';

use Expression\ExpressionBuilder;
use Expression\Attribute;
use Expression\Attributes\AttributeNames;
use Expression\Attributes\AttributeValues;
use Aws\DynamoDb\Marshaler;
use Expression\Placeholders\Placeholder;
use Expression\ExpressionProcessor;
use Expression\Condition;
use Expression\Operands\Operand;
use Expression\Functions;
use Expression\Conditions\Functions\Enums\AttributeTypesEnum;
use Expression\Predicates\BeginsWithDigitPredicate;
use Expression\Predicates\HasSpecialCharsPredicate;
use Expression\Predicates\IsReservedWordPredicate;
use Expression\Operators\Not;
use Expression\Conditions\Functions\BeginsWith;


try {
    $expression = (new ExpressionBuilder(new Not(Functions::contains(Attribute::create('attr1')->index(2)->with('path.with.dots'), 'text'))))
        ->and(
            [
                Condition::size(Attribute::create('1attribute')->with('at-tr')->with('binary'))->gt(2),
                Condition::operand(Attribute::create('something')->with('simple'))->in([2, 7, 8])
            ]
        )
        ->orNot(
            fn($innerBuilder) => $innerBuilder(Functions::attributeType(Attribute::create('some.Another.attr')->index(8), AttributeTypesEnum::NumberSet))
                ->and(Condition::operand(Attribute::create('map')->with('list')->index(4))->between(10, 12))
                ->and(Condition::operand(Attribute::create('someKey'))->between(2, 1))
                ->getExpression()
        )
        ->andNot(Functions::beginsWith(Attribute::create('ma_p2')->with('path'), 'someValue'))
        ->getExpression();

    $predicate = new BeginsWithDigitPredicate();
    $predicate->setNext(new HasSpecialCharsPredicate())->setNext(new IsReservedWordPredicate());

    $expressionProcessor = new ExpressionProcessor(new AttributeNames(), new AttributeValues(new Marshaler), new Placeholder('#', 'key'), new Placeholder(), $predicate);
    $expressionProcessor->process(
        $expression->getOperands(),
        function(string $type, string|float|int|bool $value, Operand $operand) {
            return  (('someKey' === $operand->__toString() || BeginsWith::class === $type) ? 'SomePrefix::' : '') . $value;
        }
    );

    printLine($expression->evaluate());
    printLine(json_encode($expressionProcessor->getExpressionAttributeNames()));
    printLine(json_encode($expressionProcessor->getExpressionAttributeValues()));

} catch (Throwable $ex) {
    echo $ex->getMessage();
}

function printLine(string $line)
{
    echo "<p>$line</p>";
}
