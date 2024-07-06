/*Bang luu tin tuyen dung*/
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tieude VARCHAR(200) NOT NULL,
    id_chinhanh int not null,
    vitrituyen VARCHAR(200) NOT NULL,
    id_phongban int not null,
    soluong SMALLINT DEFAULT 1,
    dotuoi VARCHAR(200) NOT NULL,
    gioitinh CHAR(10) NOT NULL,
    hannophoso DATE NOT NULL,
    ngaydangtin DATE NOT NULL,
    chitietcv VARCHAR(5000),
    yeucaucv VARCHAR(5000),
    quyenloi VARCHAR(5000),
    mucluong varchar(100),
    status BOOLEAN DEFAULT 1,
    CONSTRAINT fk_id_phongban FOREIGN KEY (id_phongban) REFERENCES phongban(id_phongban),
    CONSTRAINT fk_id_chinhanh FOREIGN KEY (id_chinhanh) REFERENCES chinhanh(id_chinhanh)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu phong ban*/
create table phongban (
	id_phongban int auto_increment primary key,
	tenphongban varchar(200) not null
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu chi nhanh*/
create table chinhanh (
	id_chinhanh int auto_increment primary key,
    tenchinhanh varchar(200) not null
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu quoc tich*/
create table quoctich (
	id_quoctich char(2) primary key,
    tenquocgia varchar(100) not null
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu dan toc*/
create table dantoc (
	id_dantoc int auto_increment primary key,
    tendantoc varchar(100) not null
)engine=InnoDB default charset=utf8mb4;

/*Bang luu Tinh,, thanh*/
create table tinhthanh (
	id_tinhthanh int primary key,
    tentinhthanh varchar(100) not null
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu Quan, huyen*/
create table quanhuyen (
	id_quanhuyen int not null,
    id_tinhthanh int not null,
    tenquanhuyen varchar(100) not null,
    primary key (id_quanhuyen, id_tinhthanh),
    CONSTRAINT fk_id_tinhthanh FOREIGN KEY (id_tinhthanh) REFERENCES tinhthanh(id_tinhthanh)
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu Phuong, xa*/
create table phuongxa (
	id_phuongxa int not null,
    idtinhthanh int not null,
    idquanhuyen int not null,
    tenphuongxa varchar(100) not null,
    primary key (id_phuongxa, idquanhuyen, idtinhthanh),
    CONSTRAINT fk_id_quanhuyen FOREIGN KEY (idquanhuyen) REFERENCES quanhuyen(id_quanhuyen),
    CONSTRAINT fk_idtinhthanh FOREIGN KEY (idtinhthanh) REFERENCES tinhthanh(id_tinhthanh)
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu thong tin tai khoan - khach*/
create table user (
	id int auto_increment primary key,
    email varchar(100) not null unique,
    matkhau varchar(500) not null,
    username varchar(100),
    sdt char(10),
    hoten varchar(100) not null,
    gioitinh char(10) not null,
    ngaytao date
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu thong tin ca nhan - khach*/
create table usrpersonalinfo (
	hinhdaidien varchar(300) default 'storage/unknowUser.png',
	id_user int not null primary key,
    id_quoctich char(2) default 0,
    id_dantoc int default 55,
    ngaysinh date,
    diachithuongtru varchar(4000) default '',
    dctr_sonha varchar(500) default '',
    dctr_phuong int default 0,
    dctr_quan int default 0,
    dctr_tinh int default 0,
    diachilienhe varchar(4000) default '',
    dclh_sonha varchar(500) default '',
    dclh_phuong int default 0,
    dclh_quan int default 0,
    dclh_tinh int default 0,
    tennguoithan varchar(100) default '',
    mqh varchar(100) default '',
    sdt_nguoithan char(10) default '',
    CONSTRAINT fk_id_user FOREIGN KEY (id_user) REFERENCES user(id),
    CONSTRAINT fk_id_quoctich FOREIGN KEY (id_quoctich) REFERENCES quoctich(id_quoctich),
    CONSTRAINT fk_id_dantoc FOREIGN KEY (id_dantoc) REFERENCES dantoc(id_dantoc)
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu thong tin hoc van - khach*/
create table usreducation (
	id_user int not null primary key,
    truong varchar(100) default '',
    trinhdo varchar(100) default '0',
    chuyennganh varchar(100) default '',
    xeploai varchar(50) default '',
    nambatdau char(4) default '',
    namketthuc char(4) default '',
    CONSTRAINT fk_id_user_education FOREIGN KEY (id_user) REFERENCES user(id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu thong tin ky nang - khach*/
create table usrskill (
	id_user int not null primary key,
    tinhoc varchar(200) default '',
    ngoaingu varchar(200) default '',
    skillkhac varchar(1000) default '',
    CONSTRAINT fk_id_user_skill FOREIGN KEY (id_user) REFERENCES user(id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu thong tin kinh nghiem viec lam - khach*/
create table usrworkexperience (
	id_user int not null primary key,
    congviec varchar(500) default '',
    nambatdau char(4) default '',
    namketthuc char(4) default '',
    tencty varchar(100) default '',
    vitri varchar(100) default '',
    nvchinh varchar(500) default '',
    luonghientai char(50) default '',
    luongmongmuon char(100) default '',
    CONSTRAINT fk_id_user_experience FOREIGN KEY (id_user) REFERENCES user(id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu thong tin nguoi than lam tai cong ty - khach*/
create table usrnguoithan (
	id_nguoithan int auto_increment primary key,
    id_user int not null,
    hoten_nguoithan varchar(100) default '',
    mqh_nguoithan varchar(100) default '',
    noilamviec_nguoithan varchar(200) default '',
    sdt_nguoithan char(10) default '',
    CONSTRAINT fk_id_user_nguoithan FOREIGN KEY (id_user) REFERENCES user(id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu tai khoan admin*/
create table admin (
	id int auto_increment primary key,
    email varchar(100) not null unique,
    matkhau varchar(500) not null,
    username varchar(100),
    sdt char(10) not null,
    hoten varchar(100) not null,
    gioitinh char(10) not null,
    ngaytao date
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

/*Bang luu ho so ung tuyen*/
create table ungtuyen (
	id int auto_increment primary key,
    id_user int not null,
    id_post int not null,
    ngayungtuyen date not null,
    ngayphongvan date,
    ngaynhanviec date,
    trangthai varchar(100) not null default 'Chờ xử lý',
    ghichu varchar(4000) default '',
    CONSTRAINT fk_id_user_intern FOREIGN KEY (id_user) REFERENCES user(id),
    CONSTRAINT fk_id_post FOREIGN KEY (id_post) REFERENCES posts(id)
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;
