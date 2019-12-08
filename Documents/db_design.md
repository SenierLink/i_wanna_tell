# 数据库设计

## table message

    create database i_wanna_tell;
    use database i_wanna_tell;
    create table Message(
        title varchar(40) not null,
        content varchar(300) not null,
        message_kind varchar(15),
        create_time timestamp not null DEFAULT CURRENT_TIMESTAMP,
        agree_num int(5) DEFAULT 0,
        browse_num int(6) DEFAULT 0,
        author_id varchar(20),
        id int(5) auto_increment not null,
        primary key(id)
    );

## db时间设计

在这里面没有办法很好地生成默认的时间和日期分离，timestamp是不分离的。要不然就用php做，要不然就在select语句中做处理。
用sql来处理，

    实例
    time_format(value)=time_format(i_want)
    或者：
    SELECT * FROM `message` WHERE to_days(create_time)=to_days(now())

字段默认time就用timestamp。

# 设计

放弃使用mvc开发，使用单页面结合mc模式。