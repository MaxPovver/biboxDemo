# biboxDemo
Working example of bibox API

This repo will help if you have 3011 error for all your private API calls - "The interface does not support apikey request methods".
`{"error":{"code":"3011","msg":"接口不支持apikey请求方式"}}`

It contains exaple of how to use Bibox API

Note the mistake many people make, is passing commands as a single json object, it must always be an array.

So if your command looks like {"cmd":"bla_bla_bla","something":"abc"}, you still must sign it as json array and pass it in paramter "cmds" as array.
```
{"cmds":"{\"cmd\":\"orderpending\\\/orderHistoryList\",\"body\":{\"account_type\":0,\"page\":1,\"size\":50}}",
"apikey":"a9072422debd0b1e816cbea1260487883ae4514a","sign":"51ac55442a56f5460644a19717d27868"}
```
it must look like
```
{"cmds":"[{\"cmd\":\"orderpending\\\/orderHistoryList\",\"body\":{\"account_type\":0,\"page\":1,\"size\":50}}]",
"apikey":"a9072422debd0b1e816cbea1260487883ae4514a","sign":"5a77711936ea174f96394e01530bf394"}
```

Note [] brackets added in the beginning and ending of "cmds" value.
