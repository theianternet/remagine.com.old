# Remagine.com - WordPress Site Backup

This repository contains a backup of the remagine.com WordPress website, archived on November 29, 2025.

## Contents

- `public_html/` - Complete WordPress installation and website files
- `remagine_db_backup_2025-11-29_10-03.sql` - MySQL database backup (21MB)
- `macri/` - Additional archived files
- `.gitignore` - Excludes large files (>50MB) from version control

## WordPress Configuration

**Database Credentials:**
- Database Name: `remagine`
- Database User: `remagine`
- Database Password: `robotfrog101`
- Database Host: `localhost`

## Server Information

**Original Server:**
- Host: ubuntu@remagine.com
- Port: 4092
- Path: `/var/www/remagine/public_html/`

## Large Files Excluded

The following files are excluded from git due to size (>50MB):
- `macri/Macri_History1.zip` (90MB)
- `remagine_files_backup.tar.gz` (464MB) - Complete compressed backup

## Project Size

- Total: ~1.0GB
- WordPress files: 581MB
- Database: 21MB

## Notes

This is an archived WordPress site that has not been updated in several years. The backup was created as part of migrating legacy projects to GitHub for preservation.

## Backup Date

2025-11-29 10:03 AM
