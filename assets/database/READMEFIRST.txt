README - How to Import SQL Database

Follow these steps to import the SQL database into your MySQL server:

1. **Open phpMyAdmin**
   - Go to your web browser and open phpMyAdmin.
   - Login with your MySQL username and password.

2. **Create a New Database** (if needed)
   - If you encounter an error while importing, create a new database manually.
   - Click on "Databases" in phpMyAdmin.
   - Enter the database name as `coffee_shop`.
   - Click "Create".

3. **Import the SQL File**
   - Select the `coffee_shop` database from the left panel.
   - Click on the "Import" tab.
   - Click "Choose File" and select your `.sql` file.
   - Ensure the format is set to "SQL".
   - Click "Go" to start the import process.

4. **Fix Errors if Any**
   - If you get an error, delete the existing database and recreate it as `coffee_shop`.
   - Try importing the `.sql` file again.
   - Check the SQL file for syntax errors or missing table dependencies.

5. **Verify the Import**
   - Once the import is successful, check the tables inside the `coffee_shop` database.
   - If everything looks correct, your database is ready for use.

**Troubleshooting Tips:**
- Ensure that your `.sql` file is not corrupted.
- Check for missing privileges in MySQL user settings.
- If import size is too large, increase `max_upload_size` and `max_execution_time` in `php.ini`.

If you still face issues, try using the MySQL command line to import:
```bash
mysql -u root -p coffee_shop < coffee_shop.sql
```

