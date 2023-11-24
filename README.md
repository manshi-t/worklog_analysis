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
- After click of search button , we will get list of files of selected module.
- Then we need to select file which we want to view work-log.
- when we select file , there will be one pop-up box display that contain file name as title of pop-up and log of that file as body of pop-up box and there will be close and view full page button in footer of pop-up box.
- when we click on close button , pop-up box will be closed.
- when we click on View Full Page button , we will view log details of that file in new tab full page.