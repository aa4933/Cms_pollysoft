基于Yii 2 Basic Project Template/LeanCloud php sdk
============================

这个项目基于开源框架Yii2建立，引入leancloud php sdk拓展，用途是用于公司的后台管理，版本为V1.0初代版本，去除leancloud数据库信息，仅作为初代古董demo样本保存，纪念第一次独立开发

Yii2目录（引用自基础模版MD）
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



要求
------------

最低PHP版本为5.4.0


关于安装
------------

### 必须修改的文件


设置cookie KEY 在 `config/web.php` 下的以下配置点

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

你可以通过使用wampserver用以下路由访问

~~~
http://localhost/basic/web/
~~~


### 使用composer安装《建议使用此方法安装拓展package》

如果没有 [Composer](http://getcomposer.org/)你可以通过以下地址获取
在 [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).


其他配置
-------------

### 数据库

目录在 `config/db.php` 

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**后记**
- 由于采用的是leancloud远程的方式进行云存储，一般此项目是不需要数据库的
- 另外此项目有很多并没有写在`config/`目录下，不符合项目开发高内聚低耦合的特殊性，所以项目总体青涩 
- 本项目作为初代版本，仅仅为了纪念第一次开发上传至github，并不代表项目可以完全驾驭各种场景
- 感谢Yii2的框架学习与认识，让我见识到了很多成熟的开发模式，同时也发现了我个人的不足
