# laravel5.5_cms
Laravel5.5后台管理系统模板
# 功能
 中间件 - 判断当前用户是否有权限操作(redis缓存用户拥有的权限)
 管理员管理 - 添加、编辑、删除、禁用；
 角色管理
 权限管理
 操作日志
 # 安装
 1、克隆到本地
 git clone 
 2、下载相关的依赖包
 composer install
 3、拷贝.env文件
 cp .env.example .env
  在 .env文件中配置好数据库
 4. 生成秘钥
 php artisan key:generate
 将生成的秘钥添加在 .env配置文件中的APP_KEY
 5、配置域名到
 在 .env文件中配置好数据库，迁移数据文件
