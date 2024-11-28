## Admin Interface of PiLock-System

### Dashboard.php
![Dashboard View - PiLock System!](/guides/images/admin/dashboard.png "Dashboard View - PiLock System!")

This Page shows count of Students, Schedules, Faculties, Courses, Sections and Events with a summary of Weekly Student RFID Taps, and Student Per Program. It shows also the Current Schedule/Events for the Instructors, and Lastly, It can monitor the Device's Usage including RAM, Storage and Temperature.

### RFID Checker.php
![RFID Checker - PiLock System!](/guides/images/admin/rfidchecker.png "RFID Checker - PiLock System!")

This Page shows RFID Checker to Check if the RFID Cards of both Students and Faculties are Exists in the System by Tapping their ID's using Plug & Play RFID Reader.

### Sections.php
![RFID Checker - PiLock System!](/guides/images/admin/sections.png "RFID Checker - PiLock System!")

### Sections (CRUD).php
![Sections (CRUD) - PiLock System!](/guides/images/admin/sectionscrud.gif "Sections (CRUD) - PiLock System!")

This Page allows you to Create, Update and Delete Sections with a Dropdown Menu: Program, Year, and Block like this Picture above.

### Courses.php
![Courses - PiLock System!](/guides/images/admin/courses.png "Courses - PiLock System!")

### Courses (CRUD).php
![Courses (CRUD) - PiLock System!](/guides/images/admin/coursescrud.gif "Courses (CRUD) - PiLock System!")

This Page allows you to Create, Update and Delete Courses with a Following Fields: Course Code, Course Title, Program, Year, Block, Faculty and Enrollment Key. Take a look the picture at the above.

### Students.php
![Students - PiLock System!](/guides/images/admin/students.png "Students - PiLock System!")

### Students (CRUD).php
![Students (CRUD) - PiLock System!](/guides/images/admin/studentscrud.gif "Students (CRUD) - PiLock System!")

This Page allows you to Create, Update and Delete Students with a Following Fields: Student ID, First Name, Last Name, Section, Gender, Email and Password. Also, you can register student's ID in "Add Tag UID" section by tapping Student's ID using RFID Scanner and Typing a Student ID. You can Disable their RFID Cards if incase the Student's ID is Stolen or Lose. And lastly, you can search and filtering the students to make organized. Take a look the picture at the above.

### Faculties.php
![Faculties - PiLock System!](/guides/images/admin/faculties.png "Faculties (CRUD) - PiLock System!")

### Faculties (CRUD).php
![Faculties (CRUD) - PiLock System!](/guides/images/admin/facultiescrud.gif "Faculties - PiLock System!")

This Page allows you to Create, Update and Delete Faculties with a Following Fields: First Name, Last Name, Gender, Email and Password. Also, you can faculties ID in "Add Tag UID" section by tapping Faculties ID using RFID Scanner and Typing a Faculty ID. You can Disable their RFID Cards if incase the Faculty ID is Stolen or Lose. Take a look the picture at the above.

### Events.php
![Events - PiLock System!](/guides/images/admin/events.png "Events - PiLock System!")

### Events (CRUD).php
![Events (CRUD) - PiLock System!](/guides/images/admin/eventscrud.gif "Events - PiLock System!")

This Page allows you to Create, View, Update, Delete Events by clicking the Calendar Dates. Here's the Fields that you need to fill up: Title, Description, Event Start, Event End. You can also drag existing event to other dates. By Clicking the Event, you can View, Update and Delete the Event. You can click these Buttons: "Current, Previous, Next" when you move to Next/Previous Months. Take a look the picture at the above.

### Schedules (Table).php
![Schedules (Table) - PiLock System!](/guides/images/admin/schedules.png "Schedules (Table) - PiLock System!")

### Schedules (Timetable).php
![Schedules (Timetable) - PiLock System!](/guides/images/admin/schedulestime.png "Schedules (Timetable) - PiLock System!")

In this Page, there are 2 Types of Viewing the Schedules: "Timetable, Table". Timetable is much Cleaned and Organized compare to Table View.

### Schedules (CRUD).php
![Schedules (CRUD) - PiLock System!](/guides/images/admin/schedulescrud.gif "Schedules (CRUD) - PiLock System!")

This page also, It allows you to Create, View, Update and Delete with a Following Fields: Course & Section, Days, Time Start, Time End, Late Tolerance. To create the schedule, Click the "Add Schedule", and fill up some fields. To View, Update, and Delete Schedule. Click the "Yellow Background" inside table and you can execute some buttons below.

### Make-Up Schedules.php
![Makeup-Schedules - PiLock System!](/guides/images/admin/makeupsched.png "Makeup-Schedules - PiLock System!")

### Make-Up Schedules (CRUD).php
![Makeup-Schedules (CRUD) - PiLock System!](/guides/images/admin/makeupschedcrud.gif "Makeup-Schedules (CRUD) - PiLock System!")

In this page, It allows you to Create, Update and Delete Makeup-Schedule depends to admin side. Faculty Side can have this module as well, but mostly Faculties can Create, Update and Delete is Makeup-Schedules. The Process of CRUD is Same as the Schedules (CRUD).

### Make-Up Schedules Approval.php
![Make-Up Schedules Approval - PiLock System!](/guides/images/admin/makeupschedapprovals.gif "Make-Up Schedules Approval - PiLock System!")

In this Page The Admins will Approve or Decline the Schedules Added by the Faculties.

### Admins.php
![Admins - PiLock System!](/guides/images/admin/admins.png "Admins - PiLock System!")

This page is Admins wherein the Super-Admin can manage this. Add, Edit and Delete Administrator Account and Assigned Admins with Different Roles.

### Roles.php
![Roles - PiLock System!](/guides/images/admin/rolescrud.gif "Roles - PiLock System!")

This page is Roles wherein the Super-Admin can manage this. Adding Role, Edit and Delete and Assigned Permission each Roles.

### Permissions.php
![Permissions - PiLock System!](/guides/images/admin/permissions.png "Permissions - PiLock System!")

This Page is Automatic Configuration including the Admins, Roles using the DatabaseSeeder. You can also customize the permissions you want to.


### Logs.php
![Logs - PiLock System!](/guides/images/admin/logs.gif "Logs - PiLock System!")

This page is Logs of both Students and Faculties including Time in and Time out. It allows to Filter Courses and Date at the same time, It Allows to Export the Logs Data to Excel File by Selecting Course & Section, From and To Date.

### Settings.php
![Settings - PiLock System!](/guides/images/admin/settings.png "Settings - PiLock System!")

This page is a Configuration for Admins, Faculties and Students. There are many types of Configuration:

- Database Configuration - This Section is a Truncate of all Tables with Confirmation Dialog.

- Switches - This Sections is a controls of 3 Interfaces: (Admin, Faculties and Students).

- Website Configuration - This section can be accessed by Super-Admin only.

    - Archive Data - shows the Previous Data of Students and Faculties. It will be executed after Semester.

    - Laboratory Seats - This will be configuration of Seats if the Laboratory Seat-Plan will be changed.

    - API Token - This will be the Accessing the API Endpoints with Provided by Token.

- Admin Profile Information - This Section is the Admin Information including First Name, Last Name, Email Address and Theme. It can be changed anytime you want.

- Admin Change Password - This Section will be Changing your Password anytime.

### Laboratoy Seats.php
![Laboratory Seats - PiLock System!](/guides/images/admin/seatconfiguration.gif "Laboratory Seats - PiLock System!")

This Page wherein you can configure the seats by typing the Row and Column based on Laboratory Arrangement. You can also click the square to arranging the seats. You can Save Configuration and Load.
