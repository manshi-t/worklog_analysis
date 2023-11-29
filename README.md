Work-log Analysis 
======




Installation
-----

Run a command,

```
composer require mansi/website-analytics
```

Usage
-----
Show Analysis of module wise work-log files and it's work-log.

- There is view page called index.blade.php.It Include drop-down list and search button.
- Drop-down list contain all subdirectories(modules) of logs directoy. for that it reads logs directory.
- view work-log of particular module,we need to select module from drop-down list and click on search button.
- After click of search button ,if folder is empty then get message 'Folder is empty.' otherwise we will get list of files of selected module.
- There is also pagination avilable.we can see 20 file name on page.If there is more then 20 file then it will be other page.
- Then we need to select file which we want to view work-log.
- when we select file , there will be one pop-up box display that contain file name as title of pop-up and log(content) of that file if file have content otherwise message 'File is empty.' as body of pop-up box and there will be close and view full page button in footer of pop-up box.
- if file is empty then View Full Page button is disable.
- when we click on close button , pop-up box will be closed.
- when we click on View Full Page button , we will view log details of that file in new tab full page.

- Ex:-
    - In index.blade.php there drop-down list which include module name 
        - ProductManagementLogs
        - CategoryManagementLogs
        - JobConfigurationLogs
        - CMSPagesLogs
        - UserAnalyticsLogs
        - ExportProductLogs
    
    - From that options you need to select one at a time. For Ex you have selected ProductManagementLogs option and then click on search button , you will get list of files of that particular folder.
        - product.log
        - product_2023_11_19.log
        - product_2023_11_20.log
    
    - After you need to select any file for purpose of view logs of that file.whenever you click on any file , you can see pop up box with log content of that file and pop box have button called view full page , on click of that button you will be redirected to new tab with that content.