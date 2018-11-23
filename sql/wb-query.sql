select * from wb_user;
select * from wb_userbios;
select * from wb_usergroups;
select * from vw_user;
select * from wb_pagetypes;
select * from wb_content;
select * from vw_contentList where contentId = 20;

select * from wb_articles where contentId = 89;
select * from wb_pagetypes;
select * from wb_headers;
select * from wb_menugroups;
select * from vw_menulist;
select * from vw_menulist2;
select * from vw_contentList;
select * from wb_menuitems;
select * from vw_content;
select * from wb_user;
select * from vw_user;

select * from wb_groupvw_contentlists;

/*DROP view IF EXISTS `vw_content`;*/
CREATE VIEW `vw_content` AS
SELECT wb_content.ID, guid, lang, defaultParentId, wb_content.permalink, title, status, target, 
	shortDescription, creatorId, ownerId, vw_user.type ownerType, vw_user.fullName ownerFullName,
    vw_user.permalink ownerLink, wb_content.pageType, wb_pagetypes.canEdit, wb_pageTypes.hasRightbar,
    galleryImage, pageArgument, articleFile, articleImage, articleDescription, ogType, authorFullName, 
    authorLink, dateCreated, dateModified
    from wb_content left join vw_user on wb_content.ownerId = vw_user.ID, wb_pagetypes
    where wb_content.pageType = wb_pagetypes.pageTypeName;

/* drop view vw_contentlist; */
CREATE VIEW `vw_contentlist` AS
select wb_menuItems.ID itemId, wb_menuitems.menuId, wb_menuitems.menuType, 
wb_content.ID contentId, lang, defaultParentId, permalink, title, sequence, status, target, 
galleryImage, pageType, ownerId, authorFullName, authorLink, articleImage, articleDescription, ogType 
from wb_menuitems, wb_content 
where wb_menuitems.contentId = wb_content.ID 

/*drop view vw_menulist;*/
/* old menulist
CREATE VIEW `vw_menulist` AS
select `wb_content`.`ID` AS `ID`,
	`wb_content`.`lang` AS `lang`,
    `wb_content`.`permalink` AS `permalink`,
	`wb_content`.`title` AS `menuTitle`,
	`wb_content`.`shortDescription` AS `menuDescription`,
    `wb_content`.`status` AS `status`,
    `wb_menuitems`.`sequence` AS `mlseq`,
    `wb_content`.`ownerId` AS `owner`,
    `wb_content`.`pageType` AS `pageType`,
    `wb_content`.`galleryImage` AS `galleryImage`
    from `wb_content` left join `wb_menuitems` on wb_content.ID = wb_menuitems.contentid 
    where (`wb_content`.`pageType` in (select pageTypeName from wb_pagetypes where isMenu = TRUE));
*/

/* drop view vw_menulist; */
CREATE VIEW `vw_menulist` AS
select `wb_content`.`ID` AS `menuId`,
	`wb_content`.`lang` AS `m_lang`,
	`wb_content`.`defaultParentId` AS `m_parentId`,
    `wb_content`.`permalink` AS `m_permalink`,
	`wb_content`.`title` AS `menuTitle`,
	`wb_content`.`shortDescription` AS `menuDescription`,
    `wb_content`.`status` AS `m_status`,
    `wb_content`.`ownerId` AS `m_ownerId`,
    `wb_content`.`pageType` AS `m_pageType`
    from `wb_content`
    where `wb_content`.`pageType` in (select pageTypeName from wb_pagetypes where isMenu = TRUE);


/*drop view vw_user;*/
create view vw_user as
select wb_user.ID, userBlob, username, password, permalink, fullName, theme, type, pageType
from wb_user left join wb_content on wb_user.profileId = wb_content.ID;

/*drop table wb_usergroups;*/
create table wb_usergroups (
	ID integer NOT NULL AUTO_INCREMENT,
    userId integer,
    name varchar(63) NOT NULL,
    shortDescription varchar(127),
	PRIMARY KEY (`ID`)
);

/*drop table wb_groupslists;*/
create table wb_grouplists (
	ID integer NOT NULL AUTO_INCREMENT,
    groupId integer,
    userId integer,
    PRIMARY KEY (`ID`)
);

alter table wb_pagetypes add column hasRightbar tinyint after canEdit; 

/*
alter table wb_menuitems add column menuType tinyint after menuId;
alter table wb_content change column lang lang varchar(6);
alter table wb_usergroups change column lang lang varchar(6);
alter table wb_content add column creatorId integer after shortDescription;
alter table wb_content change column userId ownerId integer;
alter table wb_content add column articleURL varchar(255) after articleFile;
alter table wb_content add column articleImage varchar(127) after articleURL;
alter table wb_content add column articleDescription text after articleImage;
alter table wb_content add column ogType varchar(31) after articleDescription;
alter table wb_content add column authorFullName varchar(31) after ogType;
alter table wb_content add column authorLink text after authorFullName;
alter table wb_usergroups add column lang varchar(3) after shortDescription;

update wb_content set lang = "en_US" where lang = "en";
update wb_content set lang = "fr_FR" where lang = "fr";
update wb_content set lang = "de_DE" where lang = "de";
update wb_content set lang = "it_IT" where lang = "it";

update wb_usergroups set lang = "en_US" where lang = "en";
update wb_usergroups set lang = "fr_FR" where lang = "fr";
update wb_usergroups set lang = "de_DE" where lang = "de";
update wb_usergroups set lang = "it_IT" where lang = "it";

*/

select * from wb_menuitems where contentId = 426;
select * from wb_content where title like "Main Menu%";

select vw_content.ID, vw_content.guid, vw_content.lang, vw_content.defaultParentId, vw_content.permalink, vw_content.title, vw_content.status, vw_content.target, vw_content.shortDescription, vw_content.creatorId, vw_content.ownerId, vw_content.ownerType, vw_content.pageType, vw_content.galleryImage, vw_content.articleFile, vw_content.articleImage, vw_content.articleDescription, vw_content.ogType, vw_content.authorFullName, vw_content.authorLink, vw_content.dateCreated, vw_content.dateModified, wb_content.ID parentId, wb_content.defaultParentId grandParentId, wb_content.permalink parentPermalink, wb_content.title parentTitle 
from vw_contentwhere vw_content.ID = '364' and ( vw_content.ownerId = '2' or vw_content.status in ("Linear Algebra", "Math Resources", "Classical Mechanics", "Winter School on Gravity", "Single Variable Calculus", "Probability", "Economics", "Philosophy", "Politics", "Information Theory", "Fourier Transform", "Abstract Algebra", "Differential Equations", "Music and Arts", "Computer Science", "L'informatique", "Économie", "Politique", "Philosophie", "Quantum Field Theory", "General Relativity") or vw_content.status = 'Public' )

select * from wb_content where title like 'rootContent%'




/*---------------------------------------------------------
 * current query
 */
select wb_menugroups.parentId, wb_menugroups.contentId, trackParent, mgseq, wb_menugroups.menuId, 
menuTitle, wb_menuitems.sequence seq, wb_content.permalink, wb_content.status, 
wb_content.title, wb_content.target 
from wb_menugroups, vw_menulist left join wb_menuItems on vw_menulist.ID = wb_menuitems.menuId left join wb_content on wb_menuitems.contentId = wb_content.ID and wb_menuitems.menuType = '1' and (( ownerId = '' and (wb_content.status = 'Private' or wb_content.status = 'Draft')) or wb_content.status in ('') or wb_content.status = 'Public' ) 
where wb_menugroups.menuId = vw_menulist.ID 
	and vw_menulist.lang = 'en_US' 
    and wb_menugroups.parentId = '21' 
    and wb_menugroups.contentId = '30' 
order by mgseq, menuId, sequence;

/*----------- menu_groups, menulist -> left join -> wb_menuitems wb_content -------------*/
select wb_menugroups.parentId, wb_menugroups.contentId, wb_menugroups.trackParent, wb_menugroups.mgseq, wb_menugroups.menuId, 
wb_content.title, wb_content.permalink,
vw_menulist2.m_sequence, vw_menulist2.m_permalink
from wb_menugroups, wb_content left join vw_menulist2 on wb_content.ID = vw_menulist2.menuId
where wb_menugroups.menuId = wb_content.ID 
	and vw_menulist2.menuType = '1'
	and vw_menulist2.m_lang = 'en_US' 
    and wb_menugroups.parentId = '21' 
    and wb_menugroups.contentId = '30' 
order by mgseq, menuId

/*-----------------------------------------------------------------------*/
select * from wb_menugroups where parentId = '314' and contentId = '419';


select * from vw_menulist2 where menuId = '365';


select vw_contentlist.title, vw_contentlist.sequence, vw_contentlist.permalink, vw_contentlist.status
from vw_contentlist 
where 
	vw_contentlist.lang = 'en_US' 
    and vw_contentlist.menuId = '365' 
    order by menuId, sequence

/*----------------- query for manage menus dialog ----------------*/
select vw_menulist.permalink menuPermalink, wb_menuitems.ID, wb_menuitems.menuId, 
wb_menuitems.menuType, wb_menuitems.contentId, menuTitle, menuDescription, owner, sequence, 
title, ownerId, wb_content.permalink 
from vw_menulist left join wb_menuitems on vw_menulist.ID = wb_menuitems.menuId left join wb_content on wb_menuitems.contentId = wb_content.ID 
where vw_menulist.lang like 'en_US%' 
and ((vw_menulist.owner = '2' and (wb_content.status = 'Private' or wb_content.status = 'Draft')) or wb_content.status in ("Linear Algebra", "Math Resources", "Classical Mechanics", "Winter School on Gravity", "Single Variable Calculus", "Probability", "Economics", "Philosophy", "Politics", "Information Theory", "Fourier Transform", "Abstract Algebra", "Differential Equations", "Music and Arts", "Computer Science", "L'informatique", "Économie", "Politique", "Philosophie", "Quantum Field Theory", "General Relativity") or wb_content.status = 'Public') 
order by menuTitle, menuType, sequence;

select vw_menulist2.m_permalink menuPermalink, wb_menuitems.ID, wb_menuitems.menuId, 
wb_menuitems.menuType, wb_menuitems.contentId, menuTitle, menuDescription, m_ownerId, 
wb_menuitems.sequence, wb_content.title, wb_content.ownerId, wb_content.permalink 
from vw_menulist2 left join wb_menuitems on vw_menulist2.menuId = wb_menuitems.menuId left join wb_content on wb_menuitems.contentId = wb_content.ID 
where vw_menulist2.m_lang like 'en_US%' 
and ((vw_menulist2.m_ownerId = '2' and (wb_content.status = 'Private' or wb_content.status = 'Draft')) or wb_content.status in ("Linear Algebra", "Math Resources", "Classical Mechanics", "Winter School on Gravity", "Single Variable Calculus", "Probability", "Economics", "Philosophy", "Politics", "Information Theory", "Fourier Transform", "Abstract Algebra", "Differential Equations", "Music and Arts", "Computer Science", "L'informatique", "Économie", "Politique", "Philosophie", "Quantum Field Theory", "General Relativity") or wb_content.status = 'Public') 
order by menuTitle, menuType, sequence

/*-------------------------------------------------------------------------------
 * this is a list of menu groups, and menus, with some content columns for the 
 * menu groups scroll tables
 */
 select wb_menugroups.ID, parentId, contentId, vw_menulist.permalink, shortDescription, 
 mgseq, menuTitle, menuDescription from wb_menugroups, vw_menulist, vw_content 
 where wb_menugroups.contentId = vw_content.ID 
	and wb_menugroups.menuId = vw_menulist.ID 
    and vw_menulist.lang = 'en_US' 
    and (( ownerId = '1' and (vw_menulist.status = 'Private' or vw_menulist.status = 'Draft')) or vw_menulist.status in ("Linear Algebra", "Administrators", "Programmers", "Probability", "Classical Mechanics", "Economics", "Philosophy", "Politics", "Information Theory", "Fourier Transform", "HS Math", "Lycée Mathématiques", "Abstract Algebra", "Differential Equations", "Music and Arts", "Computer Science", "L'informatique", "Économie", "Politique", "Philosophie", "Math Resources", "Graph Theory", "General Relativity") or vw_menulist.status = 'Public' ) 
    order by shortDescription, mgseq;

select wb_menugroups.ID, parentId, contentId, vw_menulist2.m_permalink, shortDescription, 
 mgseq, menuTitle, menuDescription from wb_menugroups, vw_menulist2, vw_content 
 where wb_menugroups.contentId = vw_content.ID 
	and wb_menugroups.menuId = vw_menulist2.menuId 
    and vw_menulist2.m_lang = 'en_US' 
    and (( ownerId = '1' and (vw_menulist2.m_status = 'Private' or vw_menulist2.m_status = 'Draft')) or vw_menulist2.m_status in ("Linear Algebra", "Administrators", "Programmers", "Probability", "Classical Mechanics", "Economics", "Philosophy", "Politics", "Information Theory", "Fourier Transform", "HS Math", "Lycée Mathématiques", "Abstract Algebra", "Differential Equations", "Music and Arts", "Computer Science", "L'informatique", "Économie", "Politique", "Philosophie", "Math Resources", "Graph Theory", "General Relativity") or vw_menulist2.m_status = 'Public' ) 
    order by shortDescription, mgseq

/*-------------------------------------------------------------------------------
 * this is a list of menu groups, menus, and menu items for the sidebar menu widget
 */
select wb_menugroups.parentId, wb_menugroups.contentId, trackParent, mgseq, wb_menugroups.menuId, 
menuTitle, vw_menulist.m_permalink, wb_menuitems.sequence seq, 
wb_content.ID contentId, wb_content.permalink, wb_content.status, wb_content.title, wb_content.target 
from wb_menugroups, vw_menulist left join wb_menuItems on vw_menulist.menuId = wb_menuitems.menuId left join wb_content on wb_menuitems.contentId = wb_content.ID 
	and wb_menuitems.menuType = '1' 
    and (( ownerId = '1' and (wb_content.status = 'Private' or wb_content.status = 'Draft')) or wb_content.status in ("Linear Algebra", "Administrators", "Programmers", "Probability", "Classical Mechanics", "Economics", "Philosophy", "Politics", "Information Theory", "Fourier Transform", "HS Math", "Lycée Mathématiques", "Abstract Algebra", "Differential Equations", "Music and Arts", "Computer Science", "L'informatique", "Économie", "Politique", "Philosophie", "Math Resources", "Graph Theory", "General Relativity") or wb_content.status = 'Public' ) 
    where wb_menugroups.menuId = vw_menulist.menuId 
		and vw_menulist.m_lang = 'en_US' 
        and wb_menugroups.parentId = '4' 
        and wb_menugroups.contentId = '21' 
order by mgseq, menuId, sequence;
 
select wb_menugroups.parentId, wb_menugroups.contentId, wb_menugroups.trackParent,
wb_menugroups.mgseq, wb_menugroups.menuId, 
vw_menulist.menuTitle, vw_menulist.m_permalink, 
vw_contentlist.sequence seq, 
vw_contentlist.permalink, vw_contentlist.status, vw_contentlist.title, vw_contentlist.target 
from wb_menugroups, vw_menulist left join vw_contentlist on vw_menulist.menuId = vw_contentlist.menuId
 and vw_contentlist.menuType = '1' and (( ownerId = '1' and (vw_contentlist.status = 'Private' or vw_contentlist.status = 'Draft')) or vw_contentlist.status in ("Linear Algebra", "Administrators", "Programmers", "Probability", "Classical Mechanics", "Economics", "Philosophy", "Politics", "Information Theory", "Fourier Transform", "HS Math", "Lycée Mathématiques", "Abstract Algebra", "Differential Equations", "Music and Arts", "Computer Science", "L'informatique", "Économie", "Politique", "Philosophie", "Math Resources", "Graph Theory", "General Relativity") or vw_contentlist.status = 'Public' ) 
 where wb_menugroups.menuId = vw_menulist.menuId 
	and vw_menulist.m_lang = 'en_US' 
    and wb_menugroups.parentId = '4' 
    and wb_menugroups.contentId = '21' 
order by mgseq, menuId, sequence;

/* 
insert into calliope_sutra.wb_user
select * from workbench_1.wb_user where username = "jgambini";
*/

create table wb_userbios (
	ID integer NOT NULL AUTO_INCREMENT,
    userId integer,
    lang varchar(6),
    bio text,
    PRIMARY KEY (`ID`)
);

create unique index idx_ugroups on wb_usergroups(lang,name);

alter table wb_userbios add column profileImage varchar(127) after  lang;

alter table wb_user drop column profileImage;
alter table wb_user drop column bio;