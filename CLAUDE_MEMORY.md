# Claude Memory - Remagine.com Backup Project

## Project Context

This is part of a series of backup projects where we're archiving old live WordPress sites and migrating them to GitHub for preservation. The remagine.com site is an outdated WordPress installation that needs to be backed up before potential migration or decommissioning.

## Work History

### Session: 2025-11-29

**Tasks Completed:**
1. Connected to remote server (ubuntu@remagine.com:4092) using `../remagine.pem`
2. Located WordPress installation at `/var/www/remagine/public_html/`
3. Extracted database credentials from `wp-config.php`
4. Exported MySQL database to `/tmp/remagine_db_backup.sql` (22MB)
5. Created tarball of WordPress files: `/tmp/remagine_files_backup.tar.gz` (451MB)
6. Downloaded both backups to local project directory
7. Cleaned up remote temporary files
8. Renamed database backup to include timestamp: `remagine_db_backup_2025-11-29_10-03.sql`
9. Identified large files (>50MB) and added to `.gitignore`
10. Created README.md and this memory file
11. Prepared for initial git commit

**Large Files Excluded from Git:**
- `macri/Macri_History1.zip` - 90MB (old archive data)
- `remagine_files_backup.tar.gz` - 464MB (compressed backup)

## Server Details

- **Host:** ubuntu@remagine.com
- **Port:** 4092
- **SSH Key:** `../remagine.pem` (one directory above project)
- **WordPress Path:** `/var/www/remagine/public_html/`
- **Database:** remagine / remagine / robotfrog101

## Project Structure

```
remagine.com.old/
├── .git/
├── .gitignore
├── README.md
├── CLAUDE_MEMORY.md
├── public_html/           (WordPress installation - 581MB)
├── macri/                 (archived data)
├── remagine_db_backup_2025-11-29_10-03.sql  (21MB)
└── remagine_files_backup.tar.gz  (464MB - gitignored)
```

## Notes

- This site has not been updated in several years
- User mentioned several similar backup projects have been completed previously
- The site is WordPress-based and outdated, which the user "cannot stand"
- Total project size: ~1.0GB

## Future Considerations

- Consider setting up local WordPress environment if restoration is needed
- Database credentials are stored in this repo - consider if this is acceptable for the use case
- The compressed tarball backup is excluded from git but available locally
