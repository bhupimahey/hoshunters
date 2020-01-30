<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-02 09:39:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '' at line 6 - Invalid query: SELECT DISTINCT `uspr`.*
FROM `users_profile` `uspr`
LEFT JOIN `homedes_rentbondbills` `rm` ON `rm`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `homedes_about_property` `abp` ON `abp`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `property_for_search` `pfs` ON `pfs`.`profile_id`=`uspr`.`profile_id`
WHERE (LOWER(pfs.country) LIKE '%%' AND (LOWER(pfs.location) LIKE '%new south wales%' OR  )) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15')
AND `uspr`.`profile_type` = '2'
AND `uspr`.`listing_confirmed` = '1'
AND `uspr`.`profile_status` = '1'
ERROR - 2019-12-02 09:39:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '' at line 6 - Invalid query: SELECT DISTINCT `uspr`.*
FROM `users_profile` `uspr`
LEFT JOIN `homedes_rentbondbills` `rm` ON `rm`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `homedes_about_property` `abp` ON `abp`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `property_for_search` `pfs` ON `pfs`.`profile_id`=`uspr`.`profile_id`
WHERE (LOWER(pfs.country) LIKE '%%' AND (LOWER(pfs.location) LIKE '%new south wales%' OR  )) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15')
AND `uspr`.`profile_type` = '2'
AND `uspr`.`listing_confirmed` = '1'
AND `uspr`.`profile_status` = '1'
ERROR - 2019-12-02 09:53:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '' at line 6 - Invalid query: SELECT DISTINCT `uspr`.*
FROM `users_profile` `uspr`
LEFT JOIN `homedes_rentbondbills` `rm` ON `rm`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `homedes_about_property` `abp` ON `abp`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `property_for_search` `pfs` ON `pfs`.`profile_id`=`uspr`.`profile_id`
WHERE (LOWER(pfs.country) LIKE '%australia%' AND (LOWER(pfs.state) LIKE '%new south wales%' OR LOWER(pfs.city) LIKE '%homebush%' OR  LOWER(pfs.street) LIKE '%homebush strathfield nsw%' OR LOWER(pfs.postcode) LIKE '%2140%' OR LOWER(pfs.location) LIKE '%homebush strathfield nsw%' OR  )) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15')
AND `uspr`.`profile_type` = '2'
AND `uspr`.`listing_confirmed` = '1'
AND `uspr`.`profile_status` = '1'
ERROR - 2019-12-02 09:53:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '' at line 6 - Invalid query: SELECT DISTINCT `uspr`.*
FROM `users_profile` `uspr`
LEFT JOIN `homedes_rentbondbills` `rm` ON `rm`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `homedes_about_property` `abp` ON `abp`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `property_for_search` `pfs` ON `pfs`.`profile_id`=`uspr`.`profile_id`
WHERE (LOWER(pfs.country) LIKE '%australia%' AND (LOWER(pfs.state) LIKE '%new south wales%' OR LOWER(pfs.city) LIKE '%homebush%' OR  LOWER(pfs.street) LIKE '%homebush strathfield nsw%' OR LOWER(pfs.postcode) LIKE '%2140%' OR LOWER(pfs.location) LIKE '%homebush strathfield nsw%' OR  )) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15')
AND `uspr`.`profile_type` = '2'
AND `uspr`.`listing_confirmed` = '1'
AND `uspr`.`profile_status` = '1'
ERROR - 2019-12-02 09:53:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '' at line 6 - Invalid query: SELECT DISTINCT `uspr`.*
FROM `users_profile` `uspr`
LEFT JOIN `homedes_rentbondbills` `rm` ON `rm`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `homedes_about_property` `abp` ON `abp`.`profile_id`=`uspr`.`profile_id`
LEFT JOIN `property_for_search` `pfs` ON `pfs`.`profile_id`=`uspr`.`profile_id`
WHERE (LOWER(pfs.country) LIKE '%australia%' AND (LOWER(pfs.state) LIKE '%new south wales%' OR LOWER(pfs.city) LIKE '%homebush%' OR  LOWER(pfs.street) LIKE '%homebush strathfield nsw%' OR LOWER(pfs.postcode) LIKE '%2140%' OR LOWER(pfs.location) LIKE '%homebush strathfield nsw%' OR  )) 
AND `uspr`.`preferred_language` IN('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15')
AND `uspr`.`profile_type` = '2'
AND `uspr`.`listing_confirmed` = '1'
AND `uspr`.`profile_status` = '1'
ERROR - 2019-12-02 16:34:43 --> Severity: Notice --> Undefined index: file /home/domainl6/hosthunters.com.au/flataps/controllers/Ajax.php 36
ERROR - 2019-12-02 16:34:44 --> Severity: Notice --> Undefined index: file /home/domainl6/hosthunters.com.au/flataps/controllers/Ajax.php 81
ERROR - 2019-12-02 16:34:44 --> Severity: Notice --> Undefined index: file /home/domainl6/hosthunters.com.au/flataps/controllers/Ajax.php 81
ERROR - 2019-12-02 12:03:44 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:03:44 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:03:53 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:03:54 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:04:35 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:04:38 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:04:39 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:04:39 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:05:01 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 12:05:01 --> Severity: Warning --> rand() expects exactly 2 parameters, 1 given /home/domainl6/hosthunters.com.au/flataps/libraries/Captcha.php 43
ERROR - 2019-12-02 17:37:43 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 17
ERROR - 2019-12-02 17:37:43 --> Severity: Warning --> getimagesize(/home/domainl6/hosthunters.com.au//assets/captcha/captcha_bg.png): failed to open stream: No such file or directory /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 21
ERROR - 2019-12-02 17:37:43 --> Severity: Warning --> imagecreatefrompng(/home/domainl6/hosthunters.com.au//assets/captcha/captcha_bg.png): failed to open stream: No such file or directory /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 24
ERROR - 2019-12-02 17:37:43 --> Severity: Warning --> imagealphablending() expects parameter 1 to be resource, boolean given /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 25
ERROR - 2019-12-02 17:37:43 --> Severity: Warning --> imagesavealpha() expects parameter 1 to be resource, boolean given /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 26
ERROR - 2019-12-02 17:37:43 --> Severity: Warning --> imagecolorallocate() expects parameter 1 to be resource, boolean given /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 29
ERROR - 2019-12-02 17:37:43 --> Severity: error --> Exception: Font file not found: /home/domainl6/hosthunters.com.au//assets/captcha/times_new_yorker.ttf /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 38
ERROR - 2019-12-02 17:37:43 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/domainl6/hosthunters.com.au/flatsys/core/Exceptions.php:271) /home/domainl6/hosthunters.com.au/flatsys/core/Common.php 570
ERROR - 2019-12-02 17:37:47 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 17
ERROR - 2019-12-02 17:37:47 --> Severity: Warning --> getimagesize(/home/domainl6/hosthunters.com.au//assets/captcha/captcha_bg.png): failed to open stream: No such file or directory /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 21
ERROR - 2019-12-02 17:37:47 --> Severity: Warning --> imagecreatefrompng(/home/domainl6/hosthunters.com.au//assets/captcha/captcha_bg.png): failed to open stream: No such file or directory /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 24
ERROR - 2019-12-02 17:37:47 --> Severity: Warning --> imagealphablending() expects parameter 1 to be resource, boolean given /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 25
ERROR - 2019-12-02 17:37:47 --> Severity: Warning --> imagesavealpha() expects parameter 1 to be resource, boolean given /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 26
ERROR - 2019-12-02 17:37:47 --> Severity: Warning --> imagecolorallocate() expects parameter 1 to be resource, boolean given /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 29
ERROR - 2019-12-02 17:37:47 --> Severity: error --> Exception: Font file not found: /home/domainl6/hosthunters.com.au//assets/captcha/times_new_yorker.ttf /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 38
ERROR - 2019-12-02 17:37:47 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/domainl6/hosthunters.com.au/flatsys/core/Exceptions.php:271) /home/domainl6/hosthunters.com.au/flatsys/core/Common.php 570
ERROR - 2019-12-02 17:38:46 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 17
ERROR - 2019-12-02 17:39:01 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 17
ERROR - 2019-12-02 17:39:06 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 17
ERROR - 2019-12-02 17:39:07 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 17
ERROR - 2019-12-02 17:39:10 --> Severity: Notice --> A non well formed numeric value encountered /home/domainl6/hosthunters.com.au/flataps/controllers/Viewcaptcha.php 17
