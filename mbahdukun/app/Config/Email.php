<?php

namespace Config;

use App\Models\SettingModel;
use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail = '';
    public string $fromName = 'Mbah Dukun';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';
    public string $protocol = 'smtp';
    public string $mailPath = '/usr/sbin/sendmail';
    public string $SMTPHost = 'smtp.mail.me.com';
    public string $SMTPUser = '';
    public string $SMTPPass = '';
    public int $SMTPPort = 587;
    public string $SMTPCrypto = 'tls';

    public int $SMTPTimeout = 10;
    public bool $SMTPKeepAlive = false;
    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';
    public string $charset = 'UTF-8';
    public bool $validate = false;
    public bool $priority = false;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
    public string $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;

    public function __construct()
    {
        parent::__construct();
        $settings = new SettingModel();
        $this->fromEmail = env('email.fromEmail', 'noreply@mbahdukun.web.id');
        $this->fromName = env('email.fromName', 'Mbah Dukun');
        $this->SMTPHost = env('email.SMTPHost', 'smtp.mail.me.com');
        $this->SMTPUser = $settings->get('email.SMTPUser', env('email.SMTPUser'));
        $this->SMTPPass = $settings->get('email.SMTPPass', env('email.SMTPPass'));
        $this->SMTPPort = (int) env('email.SMTPPort', '587');
        $this->SMTPCrypto = env('email.SMTPCrypto', 'tls');
    }
}