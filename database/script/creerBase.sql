create database if not exists codeeditors
	char set utf8
    collate utf8_general_ci;
    
use codeeditors;

create table if not exists users(
	uId int auto_increment not null,
    uLogin varchar(30) not null,
    uEmail varchar(255) not null,
    uPassword varbinary(255) not null,
    uDate date not null,
    uCountry varchar(255) not null,
    uActive tinyint(1) not null,
    primary key (uId),
    unique(uLogin),
    unique(uEmail)
) ENGINE=InnoDB;

create table if not exists editors(
	eId int auto_increment not null,
    eName varchar(50) not null,
    eVersion varchar(24) not null,
    eOwner varchar(30) not null,
    eWebsite varchar(255),
    eDescription text not null,
    eDate TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    uId int not null,
    primary key(eId),
    unique(eName),
    foreign key(uId) references users(uId) ON DELETE CASCADE
) ENGINE=InnoDB;

create table if not exists like_editors(
	leId int auto_increment not null,
    uId int not null,
    eId int not null,
    primary key(leId),
    foreign key(uId) references users(uId) ON DELETE CASCADE,
    foreign key(eId) references editors(eId) ON DELETE CASCADE
) ENGINE=InnoDB;

create table if not exists configurations(
	cId int auto_increment not null,
    cName varchar(255) not null,
    cVersion varchar(255) not null,
    cDescription text not null,
    cDate TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    uId int not null,
    eId int not null,
    primary key(cId),
    foreign key(uId) references users(uId) ON DELETE CASCADE,
    foreign key(eId) references editors(eId) ON DELETE CASCADE
) ENGINE=InnoDB;

create table if not exists like_configurations(
	lcId int auto_increment not null,
    uId int not null,
    cId int not null,
    primary key(lcId),
    foreign key(uId) references users(uId) ON DELETE CASCADE,
    foreign key(cId) references configurations(cId) ON DELETE CASCADE
) ENGINE=InnoDB;
