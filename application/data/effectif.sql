CREATE DATABASE IF NOT EXISTS orchestre;
-- à n’utiliser que pour la version finale
-- et très certainement utiliser de préférence phpMyAdmin

USE orchestre;

DROP TABLE IF EXISTS effectif;
CREATE TABLE effectif (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
genre varchar(10) NOT NULL DEFAULT '',
nom varchar(64) NOT NULL,
prenom varchar(64) NULL,
naissance date NULL,
-- recrutement date null,
courriel varchar(255) NULL,
nationalite char(2) NOT NULL DEFAULT '',
ville varchar(255) NULL,
fonction varchar(255) NOT NULL
);

INSERT INTO effectif (genre, nom, prenom, naissance, courriel, nationalite, ville, fonction)
VALUES
('f','alvarez','kaitlin','1989-07-03','kaitlin.alvarez@example.com','GB','nottingham','chef'),

('f','elvebakk','ulrikke','1966-08-19','ulrikke.elvebakk@example.com','NO','slevik','v1'),
('f','herr','bruni','1979-03-21','bruni.herr@example.com','DE','aach','v1'),
('h','shelton','seth','1970-11-27','seth.shelton@example.com','IE','athenry','v1'),
('f','blanco','angeles','1991-01-06','angeles.blanco@example.com','ES','talavera de la reina','v1'),
('f','simmmons','sally','1955-01-23','sally.simmmons@example.com','US','providence','v1'),
('h','crespo','hugo','1955-12-14','hugo.crespo@example.com','ES','san sebastián','v1'),
('f','perkins','catherine','1966-11-14','catherine.perkins@example.com','US','college station','v1'),
('f','lucas','suzanna','1952-03-07','suzanna.lucas@example.com','GB','st davids','v1'),
('f','watson','sheila','1992-02-20','sheila.watson@example.com','US','lewiston','v1'),
('h','lønning','harald','1952-03-17','harald.lønning@example.com','NO','magnor','v1'),
('h','leroy','célestin','1953-10-07','célestin.leroy@example.com','FR','mulhouse','v1'),
('f','lübben','annelore','1979-03-03','annelore.lübben@example.com','DE','schönberg','v1'),
('h','neal','joshua','1994-05-21','joshua.neal@example.com','US','fayetteville','v1'),
('f','feldmeier','gudula','1967-06-15','gudula.feldmeier@example.com','DE','regensburg','v1'),
('f','alexandersen','eleonora','1978-05-11','eleonora.alexandersen@example.com','NO','leitebakk','v1'),
('h','fabre','gaspard','1983-10-24','gaspard.fabre@example.com','FR','avignon','v1'),
('f','morel','anaëlle','1957-07-18','anaëlle.morel@example.com','FR','orléans','v1'),
('f','lynch','allie','1980-09-19','allie.lynch@example.com','IE','maynooth','v1'),
('f','weaver','caroline','1945-10-20','caroline.weaver@example.com','GB','bath','v1'),

('h','larson','morris','1982-09-23','morris.larson@example.com','IE','athlone','v2'),
('h','schüle','horst','1960-05-31','horst.schüle@example.com','DE','abenberg','v2'),
('h','collins','arron','1949-08-24','arron.collins@example.com','US','antioch','v2'),
('h','shelton','duane','1948-11-15','duane.shelton@example.com','US','brownsville','v2'),
('f','flores','elena','1969-06-03','elena.flores@example.com','ES','santa cruz de tenerife','v2'),
('f','stevens','charlotte','1962-12-26','charlotte.stevens@example.com','IE','mallow','v2'),
('h','temme','ludwig','1946-09-10','ludwig.temme@example.com','DE','angermünde','v2'),
('f','weil','victoria','1968-06-29','victoria.weil@example.com','DE','marktredwitz','v2'),
('f','juvik','jasmin','1970-03-14','jasmin.juvik@example.com','NO','kjøllefjord','v2'),
('f','noel','méline','1974-06-24','méline.noel@example.com','FR','roubaix','v2'),
('h','spencer','isaiah','1947-12-18','isaiah.spencer@example.com','US','mckinney','v2'),
('h','holmes','alfred','1963-11-08','alfred.holmes@example.com','US','port st. lucie','v2'),
('h','rojas','martin','1995-07-10','martin.rojas@example.com','ES','vigo','v2'),
('f','robertson','elizabeth','1961-11-10','elizabeth.robertson@example.com','IE','navan','v2'),
('f','thorbjørnsen','stina','1946-10-28','stina.thorbjørnsen@example.com','NO','austreim','v2'),
('f','rose','judy','1952-07-25','judy.rose@example.com','IE','nenagh','v2'),
('h','mora','joaquin','1994-05-22','joaquin.mora@example.com','ES','lugo','v2'),
('f','riley','julia','1996-07-11','julia.riley@example.com','IE','navan','v2'),

('h','thingstad','truls','1979-02-13','truls.thingstad@example.com','NO','bogen','alto'),
('f','velasco','encarnacion','1969-02-09','encarnacion.velasco@example.com','ES','móstoles','alto'),
('f','vidal','antonia','1981-03-29','antonia.vidal@example.com','ES','santiago de compostela','alto'),
('f','castro','raquel','1949-04-20','raquel.castro@example.com','ES','lugo','alto'),
('h','gray','joseph','1953-01-23','joseph.gray@example.com','GB','carlisle','alto'),
('f','webb','sheryl','1970-11-07','sheryl.webb@example.com','IE','athlone','alto'),
('f','daniels','josephine','1950-12-07','josephine.daniels@example.com','US','thousand oaks','alto'),
('f','sjøthun','erica','1967-11-03','erica.sjøthun@example.com','NO','øvre årdal','alto'),
('h','buvarp','alvar','1997-05-24','alvar.buvarp@example.com','NO','rød','alto'),
('f','cruz','ellen','1950-12-04','ellen.cruz@example.com','US','los angeles','alto'),
('f','ramos','mercedes','1961-04-18','mercedes.ramos@example.com','ES','valencia','alto'),
('f','boyer','mathilde','1976-10-11','mathilde.boyer@example.com','FR','pau','alto'),
('f','hollstein','ivana','1967-11-22','ivana.hollstein@example.com','DE','bad driburg','alto'),

('h','jackson','lester','1958-07-04','lester.jackson@example.com','IE','loughrea','vlc'),
('f','skomedal','mariam','1982-07-11','mariam.skomedal@example.com','NO','kjørnes','vlc'),
('f','torres','adriana','1954-03-31','adriana.torres@example.com','ES','albacete','vlc'),
('h','schenkel','sylvester','1990-05-19','sylvester.schenkel@example.com','DE','offenburg','vlc'),
('f','stehr','fatima','1948-12-16','fatima.stehr@example.com','DE','ostvorpommern','vlc'),
('f','mittelstädt','liane','1979-01-29','liane.mittelstädt@example.com','DE','großbreitenbach','vlc'),
('f','bergo','hermine','1987-12-06','hermine.bergo@example.com','NO','våre','vlc'),
('h','blanco','alex','1970-05-04','alex.blanco@example.com','ES','cuenca','vlc'),
('h','sievert','ralph','1955-07-06','ralph.sievert@example.com','DE','kaarst','vlc'),
('f','stokkeland','isabella','1981-09-11','isabella.stokkeland@example.com','NO','smestad','vlc'),
('h','brooks','gavin','1962-09-07','gavin.brooks@example.com','GB','manchester','vlc'),
('f','clement','lya','1973-09-16','lya.clement@example.com','FR','reims','vlc'),

('f','bue','vanessa','1969-10-08','vanessa.bue@example.com','NO','svelvik','cb'),
('h','pascual','tomas','1984-06-03','tomas.pascual@example.com','ES','madrid','cb'),
('f','tønnesen','angela','1945-09-09','angela.tønnesen@example.com','NO','sjøvegan','cb'),
('h','rogers','randy','1978-09-17','randy.rogers@example.com','US','rancho cucamonga','cb'),
('f','garcia','bérénice','1965-05-26','bérénice.garcia@example.com','FR','bordeaux','cb'),
('h','watkins','jim','1948-12-10','jim.watkins@example.com','IE','roscommon','cb'),
('f','smith','christina','1962-06-09','christina.smith@example.com','US','dumas','cb'),
('f','røssland','sunniva','1970-04-07','sunniva.røssland@example.com','NO','skudeneshavn','cb'),
('h','marchand','nolan','1982-08-29','nolan.marchand@example.com','FR','nîmes','cb'),

('f','enders','doris','1983-11-16','doris.enders@example.com','DE','oelsnitz/erzgeb.','picc'),

('h','thrane','karl','1949-07-27','karl.thrane@example.com','NO','tyristrand','fl'),
('h','williams','andre','1952-10-14','andre.williams@example.com','US','bernalillo','fl'),
('h','hanson','harry','1975-08-09','harry.hanson@example.com','US','oklahoma city','fl'),
('h','kennedy','mike','1958-07-11','mike.kennedy@example.com','US','bozeman','fl'),

('f','davis','isobel','1991-01-17','isobel.davis@example.com','US','lincoln','htb'),
('f','østvold','tilje','1948-02-04','tilje.østvold@example.com','NO','malvik','htb'),
('f','porter','susan','1986-10-25','susan.porter@example.com','GB','glasgow','htb'),
('f','mjølhus','thale','1992-11-07','thale.mjølhus@example.com','NO','kilsund','htb'),

('f','castro','mary','1946-02-15','mary.castro@example.com','US','hartford','corAnglais'),

('h','thomas','justin','1959-10-13','justin.thomas@example.com','US','scurry','clarMi'),

('f','dubois','aurore','1994-04-27','aurore.dubois@example.com','FR','saint-pierre','clarSi'),
('f','garnier','mélina','1947-03-28','mélina.garnier@example.com','FR','nanterre','clarSi'),

('f','guillaume','inès','1948-07-08','inès.guillaume@example.com','FR','orléans','clarB'),

('h','prieto','alexander','1991-12-28','alexander.prieto@example.com','ES','gandía','bsn'),
('h','petit','louison','1963-05-24','louison.petit@example.com','FR','roubaix','bsn'),
('h','rogers','steve','1967-07-17','steve.rogers@example.com','IE','carrigtwohill','bsn'),
('h','herrero','ricardo','1969-04-27','ricardo.herrero@example.com','ES','orihuela','bsn'),

('f','myklebust','luka','1961-10-09','luka.myklebust@example.com','NO','sånum','cbsn'),

('f','reed','lucy','1961-10-13','lucy.reed@example.com','IE','kilkenny','sax'),

('h','gil','ismael','1947-02-10','ismael.gil@example.com','ES','pozuelo de alarcón','trp'),
('h','morrison','arthur','1975-02-07','arthur.morrison@example.com','IE','celbridge','trp'),
('h','tokle','vidar','1971-01-27','vidar.tokle@example.com','NO','skogn','trp'),
('f','döhring','julia','1949-05-06','julia.döhring@example.com','DE','esens','trp'),
('f','calvo','gema','1994-03-17','gema.calvo@example.com','ES','toledo','trp'),

('f','best','lilian','1988-08-25','lilian.best@example.com','DE','telgte','corHarmonie'),
('f','bjørgum','rebecca','1979-01-06','rebecca.bjørgum@example.com','NO','rakkestad','corHarmonie'),
('f','simon','hanaé','1946-03-07','hanaé.simon@example.com','FR','colombes','corHarmonie'),
('h','mercier','alessio','1965-08-28','alessio.mercier@example.com','FR','nanterre','corHarmonie'),
('h','montgomery','leonard','1965-01-06','leonard.montgomery@example.com','US','el monte','corHarmonie'),
('h','esteban','felipe','1990-03-30','felipe.esteban@example.com','ES','sevilla','corHarmonie'),

('h','robert','lucien','1972-08-08','lucien.robert@example.com','FR','fort-de-france','trb'),
('f','stevens','yolanda','1996-07-24','yolanda.stevens@example.com','US','charlotte','trb'),
('h','sanchez','oscar','1972-01-25','oscar.sanchez@example.com','ES','san sebastián','trb'),
('h','leon','iker','1988-08-10','iker.leon@example.com','ES','las palmas de gran canaria','trb'),

('f','walker','tracy','1955-09-03','tracy.walker@example.com','US','fairfield','tub'),

('h','rettig','harald','1990-12-30','harald.rettig@example.com','DE','frankenberg/sa.','timb'),
('h','montgomery','liam','1992-12-06','liam.montgomery@example.com','IE','cobh','timb'),

('h','rojas','angel','1947-05-11','angel.rojas@example.com','ES','zaragoza','perc'),
('f','kim','allison','1978-07-06','allison.kim@example.com','US','peoria','perc'),
('f','denis','margaux','1970-01-30','margaux.denis@example.com','FR','nancy','perc'),

('h','dittrich','waldemar','1970-09-08','waldemar.dittrich@example.com','DE','ludwigshafen am rhein','hp'),

('f','boll','betty','1960-07-21','betty.boll@example.com','DE','penzlin','claviers');


