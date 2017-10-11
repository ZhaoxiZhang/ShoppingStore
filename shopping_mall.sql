CREATE DATABASE `shopping_mall` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE DATABASE IF NOT EXISTS shopping_mall;
CHARACTER SET 'utf8';
USE shopping_mall;

--管理员
DROP TABLE IF EXISTS admin;
CREATE TABLE admin
(
    adminid int  unsigned auto_increment primary key,
    username varchar(50) not null unique,
    password char(40) not null,
    email varchar(50) not null
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--员工
DROP TABLE IF EXISTS employee;
CREATE TABLE employee(
    employeeid int unsigned auto_increment primary key,
    employeename varchar(50) not null unique,
    position varchar(40) not null,
    tel char(15) not null,
    sex char(4) check(sex in ('男','女')),
    email varchar(50),
    entrytime int unsigned not null
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--分类
DROP TABLE IF EXISTS categories;
CREATE TABLE categories
(
    catid int unsigned auto_increment primary key,
    catname varchar(50) unique
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 产品
DROP TABLE IF EXISTS goods;
CREATE TABLE goods(
    goodsid int unsigned auto_increment primary key,
    goodsname varchar(256) not null unique,
    goodssn varchar(50) not null,
    goodsnum int unsigned default 1,
    originprice decimal(10,2) not null,
    currentprice decimal(10,2) not null,
    description text,
    pubtime int unsigned not null,
    isshow tinyint(1) default 1,
    catid int unsigned not null,

    FOREIGN KEY(catid) REFERENCES categories(catid),

    CONSTRAINT chk_goodsnum CHECK (goodsnum>0),
    CONSTRAINT chk_originprice CHECK(originprice>0),
    CONSTRAINT chk_currentprice CHECK(currentprice>0)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


--订单
DROP TABLE IF EXISTS orders;
CREATE TABLE orders(
    orderid int unsigned auto_increment primary key,
    goodsid int unsigned,
    customername varchar(50) not null,
    ordernum int unsigned not null,
    amount decimal(10,2) not null,
    ordertime int unsigned not null,
    tel char(15) not null,
    address text
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


--日志
DROP TABLE IF EXISTS logs;
CREATE TABLE logs(
    logid int unsigned auto_increment primary key,
    orderid int unsigned,
    goodsid int unsigned,
    customername varchar(50),
    ordernum int unsigned not null,
    amount decimal(10,2) not null,
    ordertime int unsigned not null,
    tel char(15) not null,
    address text,
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



--创建触发器
DELIMITER //
create trigger insert_logs1
after insert  on orders
for each row
begin
    insert into logs(orderid,goodsid,customername,ordernum,amount,ordertime,tel,address)
    values(new.orderid,new.goodsid,new.customername,new.ordernum,new.amount,new.ordertime,new.tel,new.address);
end
//
DELIMITER ;


DELIMITER //
create trigger insert_logs2
after update on orders
for each row
begin
    insert into logs(orderid,goodsid,customername,ordernum,amount,ordertime,tel,address)
    values(new.orderid,new.goodsid,new.customername,new.ordernum,new.amount,new.ordertime,new.tel,new.address);
end
//
DELIMITER ;


--初始化数据库
insert
into admin(username,password,email)
values('admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin@test.com');