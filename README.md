# TaskProgress
Plugin for Mantis BT that shows a progress bar for child tasks in the task detail page. The bar is shown above the relationship table as soon as the current task has at least one child.

![alt text](https://github.com/Dev-Owl/TaskProgress/blob/master/taskprogress_example.jpg "Task progress in action")


# How to install

1. Download and unzip the plugin files to your computer
2. Upload the plugin directory TaskProgress and the files it contains files under yourMantisRoot/plugins
3. In MantisBT go to page Manage > Manage Plugins. You will see a list of installed and currently not installed plugins
Click the Install link to install a plugin.

# Configuration
You can configure two settings for the plugin, both can be found in the file TaskProgress/TaskProgress/pages/taskProgress.php:

* CHILD_TYPE = Defines the constant that identifies this bug as a child of the current one
* MIN_RESOLVEDSTATUS  = Minimum state that task is considered completed 
