<?php

namespace App\Enums;

enum Department: String
{
    case HR_DEPARTMENT = "hr";
    case ACCOUNTS_DEPARTMENT = "accounts";
    case IT_DEPARTMENT = "it";
    case WEB_DEVELOPMENT = "web_development";
    case WEB_DESIGNING = "web_designing";
    case SEO = "seo";
    case CONTENT_WRITING = "content_writing";


    public function getLabel(): string
    {
        return match ($this) {
            self::HR_DEPARTMENT => 'HR Department',
            self::ACCOUNTS_DEPARTMENT => 'Accounts Department',
            self::IT_DEPARTMENT => 'IT Department',
            self::WEB_DEVELOPMENT => 'Web Development',
            self::WEB_DESIGNING => 'Web Designing',
            self::SEO => 'SEO',
            self::CONTENT_WRITING => 'Content Writing',
        };
    }
}