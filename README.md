# simple

Пример ответа для выражений из index.php:

( not contains(attr1[2]#key0, :val0) and size(#key1.#key2.#key3) > :val1 and something.simple in (:val2, :val3, :val4) or not ( attribute_type(#key4[8], :val5) and #key5.#key6[4] between :val6 and :val7 and someKey between :val8 and :val9 ) and not begins_with(ma_p2.#key7, :val10) )

{"#key0":"path.with.dots","#key1":"1attribute","#key2":"at-tr","#key3":"binary","#key4":"some.Another.attr","#key5":"map","#key6":"list","#key7":"path"}

{":val0":{"S":"text"},":val1":{"S":"2"},":val2":{"S":"2"},":val3":{"S":"7"},":val4":{"S":"8"},":val5":{"S":"NS"},":val6":{"S":"10"},":val7":{"S":"12"},":val8":{"S":"SomePrefix::1"},":val9":{"S":"SomePrefix::2"},":val10":{"S":"SomePrefix::someValue"}}
