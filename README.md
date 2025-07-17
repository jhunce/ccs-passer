# Screening Result Application

A responsive PHP and Bootstrap application for managing screening results with CSV database functionality.

## Features

- ✅ **Responsive Design**: Modern UI with Bootstrap 5
- ✅ **CSV Database**: Simple file-based data storage
- ✅ **Import/Export**: Manage data with CSV files
- ✅ **Admin Panel**: Add, view, and manage applicants
- ✅ **Search Functionality**: Find applicants by name
- ✅ **Result Display**: Beautiful result pages with print functionality

## File Structure

```
screening-ccs/
├── index.php              # Main landing page
├── process_screening.php  # Form processing logic
├── result.php            # Result display page
├── admin.php             # Admin panel
├── export_csv.php        # CSV export functionality
├── data/
│   └── applicants.csv    # CSV database file
└── README.md            # This file
```

## Setup Instructions

### Step 1: Server Requirements
- PHP 7.4 or higher
- Web server (Apache/Nginx) or local development environment (XAMPP, WAMP, etc.)
- File write permissions for the `data/` directory

### Step 2: Installation
1. **Place files in your web server directory**
   ```
   Copy all files to your web server directory (e.g., htdocs for XAMPP)
   ```

2. **Set permissions** (if on Linux/Mac)
   ```bash
   chmod 755 data/
   chmod 644 data/applicants.csv
   ```

3. **Access the application**
   ```
   Open your browser and navigate to: http://localhost/screening-ccs/
   ```

## Usage Guide

### For Applicants (Public Access)

1. **Access the Application**
   - Open `index.php` in your browser
   - You'll see a clean, responsive form

2. **Check Results**
   - Enter your full name exactly as it appears in the database
   - Click "Check Results"
   - View your screening result (Passed or Recommended to try another department)

3. **Print Results**
   - On the result page, click "Print Result" to save/print your result

### For Administrators

1. **Access Admin Panel**
   - Navigate to `admin.php`
   - This is where you manage the applicant database

2. **Add Individual Applicants**
   - Use the "Add New Applicant" form
   - Enter full name and select result
   - Click "Add Applicant"

3. **Import CSV File**
   - Prepare a CSV file with columns: `Name, Result`
   - Use the import form to upload your CSV
   - The file will replace the current database

4. **Export Current Data**
   - Click "Export CSV" to download current applicants
   - File will be named with timestamp

5. **View All Applicants**
   - See all current applicants in the table
   - Results are color-coded (green for passed, yellow for recommended)

## CSV File Format

The application expects CSV files with this format:

```csv
Name,Result
John Doe,Passed
Jane Smith,Recommended to try another department
```

**Important Notes:**
- First row must be headers: `Name,Result`
- Names are case-sensitive for searching
- Results should be exactly: `Passed` or `Recommended to try another department`

## Sample Data

The application comes with sample data in `data/applicants.csv`:

- John Doe - Passed
- Jane Smith - Recommended to try another department
- Michael Johnson - Passed
- Sarah Wilson - Recommended to try another department
- David Brown - Passed
- Emily Davis - Recommended to try another department
- Robert Miller - Passed
- Lisa Garcia - Recommended to try another department

## Customization

### Styling
- Modify CSS in the `<style>` sections of each PHP file
- Bootstrap classes can be customized
- Color scheme uses purple gradient (`#667eea` to `#764ba2`)

### Functionality
- Add more result types in `admin.php` select options
- Modify search logic in `process_screening.php`
- Add additional fields to CSV structure

### Security Considerations
- This is a basic implementation
- For production use, consider:
  - Adding authentication for admin panel
  - Input validation and sanitization
  - HTTPS encryption
  - Database instead of CSV for large datasets

## Troubleshooting

### Common Issues

1. **"No results found" error**
   - Check spelling of the name
   - Ensure exact case matching
   - Verify the name exists in the CSV file

2. **Import not working**
   - Check CSV format (must have Name,Result headers)
   - Ensure file is actually a CSV
   - Check file permissions

3. **Export not working**
   - Ensure PHP has write permissions
   - Check browser download settings

4. **Page not loading**
   - Verify PHP is installed and running
   - Check web server configuration
   - Ensure files are in correct directory

## Browser Compatibility

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## Support

For issues or questions:
1. Check the troubleshooting section above
2. Verify your server setup
3. Test with the sample data provided

## License

This project is open source and available under the MIT License. 