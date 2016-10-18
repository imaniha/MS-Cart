#!/bin/bash


if [ -z $1 ]; then
http=
else
http=-e$1
fi

#sh /opt/SoapUI-5.2.1/bin/testrunner.sh $http -s"TESTS - create new cart" -c"new cart" -j -f tests/soapui/report/ tests/soapui/CART-API-soapui-project.xml

sh /opt/SmartBear/SoapUI-5.2.1/bin/testrunner.sh $http -s"TESTS - create new cart" -j -f tests/soapui/report/ tests/soapui/CART-API-soapui-project.xml