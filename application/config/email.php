<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
/* $config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['mail_protocol']='smtp';
$config['smtp_server']='relay.mailserv.in';
$config['smtp_user_name']='relay@meetuniversities.com';
$config['smtp_pass']='M^et4025'; */

//MasterAdmin Email Address 
$config['masterAdminEmail'] = 'debal@webinfomart.com,deepak@webinfomart.com';

$config['webMasterEmail'] = 'leadmentor@leadmentor.in';
$config['emailSubject'] = 'Account Activation';
$config['webSiteName'] = 'leadmentor';
$config['userCreate'] = 'User Create';
$config['templateCreate'] = 'Sms Template Created';
$config['resetPassword'] = 'Password Reset';
$config['changedPassword'] = 'Change Password';
$config['CampaignPerformance'] = 'Campaign Performance';
$config['campaignLogs'] = 'Campaign Logs';
$config['EventAlert'] = 'Event Reminder';
$config['MeetUnivEmail'] = 'Meetuniv@meetuniv.com';


/* End of file email.php */
/* Location: ./application/config/email.php */