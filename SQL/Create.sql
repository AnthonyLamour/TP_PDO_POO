Create schema CLICOM;

Create dbspace CLI_COM;

DROP TABLE IF EXISTS CUISINIER; 

Create table CUISINIER(ID 	    int not null AUTO_INCREMENT,
                       NOM 	    char(40) not null,
                       MDP      char(40) not null,
                       STATUE   char(40) not null,
				constraint CUISINIERPK primary key (ID));

DROP TABLE IF EXISTS PLAT; 
                
Create table PLAT(IDPLAT 	int not null AUTO_INCREMENT,
                  NOMPLAT 	char(40) not null,
                  ID        int,
				constraint PLATPK primary key (IDPLAT),
                constraint PLATFK foreign key (ID) references CUISINIER(ID) ON DELETE CASCADE ON UPDATE CASCADE);
                
DROP TABLE IF EXISTS REPAS;

Create table REPAS(IDREPAS   int not null AUTO_INCREMENT,
                   IDPLAT    int not null,
                   ID        int not null,
                   DATEREPAS date not null,
                constraint REPASPK primary key (IDREPAS),
                constraint REPASFK foreign key (IDPLAT) references PLAT(IDPLAT) ON DELETE CASCADE ON UPDATE CASCADE,
                constraint REPASFK2 foreign key (ID) references CUISINIER(ID) ON DELETE CASCADE ON UPDATE CASCADE);
                
