<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016100200644780",

		//商户私钥
		'merchant_private_key' => "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCSGsHod75GQ5Pw7kfPm+DNfjGeAsscdzsj127XxQ423tPTl7yxbaxUZBUU0DQIGPm4QIOafIWxwkXhmykBr04yBA4BYnDFhG4uAwmCBv7MGqOrJW1aZWE8ORpP6FqJZ0I0K6bYV6aqmmp70jSzLUQsiubmp4BieQbDerczVOmx7DO+OK+ADCkau42NhEWJGixxAVGIJWSUY8vifpLkOljRZEox4utQajDO0d6bSP3/3UsXwsdK5Kq0smMrruWgJ3kWdxJWuQI9g0nWza2z4zLGRDpB0jwJ31cmzXCqV5coeKuk2sX9rCwqckPPdau7411I56FY3KvNlqlBsJK1gQXfAgMBAAECggEAA2SfsDhnsNYM74F5JXcnR15w5IyIDwct1m1AY75t0BRosvdJKI21fNg+LReQvcdmtUK6S7IsoK40VUL3NtTNahfyA1I38D5dGLB1XhGvhSnxNx5NZdYI5g8lb0mkIKDHRtLksw2GD1w6sNl249pfRPGM3zpwntjUsWF+M7D7JGigrZ7QHp1OFDqPS+jg1JA8BGtKrbkB3zrvt0C4HjLPMUfM+5h84Yr6ZQpiR5rAJXQV8K2uhPTSS4nU7nHcaKZikM2+rf//NmvScP4+UhSdVzHEUuVo9vi9kEdQ9b3EwAWzBJClcXW9lXbD+XTCfpsLQfIHZpXyIyAjcijt2kCOoQKBgQDx31fgAqDHyy2dl9kKaFbyi0XvX4FR21LilLDRLPdV2jz7E7vkcURYe3nQGSszyDIEo3A0S6+7FeKNBBOtEDI12aU6SkQKTSInZGwnGqYk+TKqykxyx1oY15AjpZDIGO/LecDL127y+LVzD8FqdSESNH7IJZ/8lnHO/4SkK9wAuQKBgQCao2vJh/HSwXyGQFH17HEMCYGsqzd7+drtpTHF70jVMzO2KFVeqrF2GAG3YfwxHxKm31x29+q3t68gc9XygVv/Fb7BjYU/hZEYN7t1uWAjBr424d6eeREYdh0idFa0hTLrOZ+GvxoP83HkjyOcjCKGyturrs45S54yWE+Wiel/VwKBgQCu/qBdeolJBD9kndByLzt5EDrxDXBLARvewyWKsbXhb5xfK8/tX+XK/ssLPKp9NIK7yGQN8hSajyLyU9jIhcdOHsHkgobnzRbA2W9Ge4lphsKZvvPAt2sAPjYTFF7D5wbXeKd808l6EWd2cBfIJiZfPYvc0xwFa/O7iDM3dGQgQQKBgGzUdGhaB4PG7kdhfw0vgQPysNN/kEXtOvmjGBtwYvbA2TTqv+InCUvOa27PQ/iiILNWYTHNGuB/In4ZZ8oK5l7ow95eJhflfY7oskKQ2yrrdPUVE2K+W5y2i5yS+e6EC6jmXfIsDkCJmW88mdhz+1yX6e+yz6odINHXuvN8TdtzAoGAGdL4/a4r8nrhCJnmwQu3/fGThcVfTRozGMS625y1f7iv0sUj9nlWMNvgWVWHERnvYf+2xySNoSiCyOikQgRISfK2LaStF3VP+J2LSlbJoN+8fDq8ruXMCvPPLsI2R/GvIwGVWptfVSIfId5/gr5VcYkW6HD1spC1XCp/rKPgU3w=",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApffHTnArse+6iiKu0bRt/vGD7OyOcR+mJeuDxxoyZ6wkmOR5cQS8AoMuJDQrI/xAQNg+hRFCK68ygTU0EC8mFy6Emex1RCCS8vLD84ao/hwHOe0qMGQpDm4DtzKCtAB77PIveqoW7z/hddiQKiael3Pu9p+o66g6au21jE5uFYj6kgbz9ndzl38RbcH3zQjaHgCOSFsri09KiiO61ambzBVZpwRycBn1+K7xrNWQT6XsA1/KKwMEPdG0vhQFwDjLRqyQNLJ3tMwkAhGERJsTtSSjtJw6C4CDlx1n4r+o9RfTE5dLwzAjMhsFoJ2lEdRPPs3qFncy3zIGbfdI09qWxQIDAQAB",
);