# Moon
Yar-based rpc service framework


### yar test

> [Yar](https://www.php.net/manual/zh/book.yar.php) 是一个轻量级, 高效的RPC框架, 它提供了一种简单方法来让PHP项目之间可以互相远程调用对方的本地方法.   
并且Yar也提供了并行调用的能力. 可以支持同时调用多个远程服务的方法.

```$xslt
test/yar_server 
提供了一个yar rpc server的示例，方便快速了解yar作为服务端的使用

test/yar_client
提供了一个yar rpc client的示例，方便快速了解yar作为客户端的使用

test/yar_con_client
提供了一个yar rpc client并行的示例
```

### 项目分层
```$xslt
ROOT  服务部署目录
├—Apps            应用目录
├—--Index.php     业务代码
├—Config          配置目录
├—--Router.php    路由配置
├—Services        基础服务层
├—--Core.php      核心类
├—--Apps.php      应用服务类
├─index.php       入口文件
└─README.md       README文件
```