### Hippocampome Development Model

Source code for all aspects of the Hippocampome project is maintained on GitHub under the "hippocampome" user account.  Individual repositories are accessible from this account using the URL scheme `http://github.com/REPOSITORY_NAME`

A set of "hub" repositories ("repos") are kept on GitHub corresponding to various aspects of the project.  For example, there is a "php" repo that contains the portal PHP code.  Individual developers can maintain a local version of one or more of these repositories.  As they work on their local repo, it will diverge from the GitHub version.  When they've judged that the changes they've made are sufficiently stable, they merge their changes back into the central version (Git can automatically detect changes in files when comparing the two repos and merge them appropriately).

TODO: At present, this README only talks about a single master branch in the central repository.  Presumably we will have master, review, and development branches.

### Git Basics

Git is a distributed version control system.  There is no central git server-- there are only git "repositories", which are folders that contain a set of files along with the history of those files.  Repositories can be synchronized with one another.  GitHub is a website where you can store git repositories for free.

### Getting Started with Git

If you're using a Mac or Linux, git should already be installed on your system.  `which git` from the command line should give you the path to git.

If you use windows, youll need [Git for Windows](http://msysgit.github.io).  There are various GUIs available for using Git, but you can also control it from the command line.

### Basics for Working on PHP Portal Code (Command Line)

```sh
cd path/to/where/I/want/my/repo
```

Navigate to the directory where you want to store the repository (which is itself a directory)

```sh
git clone https://github.com/hippocampome/php.git
```

This creates a copy of the repo on your machine.  (You should only need to do this the first time you want to make changes).  Go ahead and make any changes you want.  This will only change your local version.  When you have finished making the changes:

```sh
git add .  # 'stage' all changes you've made to prepare them for commit
git commit -m "put a message here describing your changes"
git push -u origin master  # 'origin' is just an alias for the URL of the GitHub version, 'master' refers to a branch in your local version
```

That's it!  The GitHub version's 'master' branch should now reflect the new changes.  In the future, just go through the same steps again (minus the initial clone step) to push more changes.

#### Git Command Line

Git is a command suite, which means that you do run commands in the general form ` git COMMAND`.  That is `git` is a prefix for just about everything you do.

To use Git from the command line, you'll typically (unless cloning or initializing a new repo) need to navigate to the root of your repo.  Once there, you can run a variety of commands which are executed relative to the repo you are inside.

*NOTE: at a git repository contains a hidden folder called '.git' on Unix (Mac/Linux) and '_git' on Windows.  You should NOT be inside this folder-- instead, you should be in its parent, which is a normal, visible folder on the filesystem.*

Here are the minimum basic commands you will need for working with the Hippocampome.  General syntax is below the description of each command, followed by a bolded example of this command used in the context of the Hippocampome:

- Clone a repository:  
`git clone REPO_URL`  
**`git clone https://github.com/hippocampome/php.git`**
- Add an alias to your local version of the repository that points to the URL of the remote version you will be synchronizing with:  
`git remote add ALIAS_NAME URL`  
**`git remote add origin http://github.com/hippocampome/php.git`**
- Stage changes to be committed to your local version:  
`git add .`  
**`git add .`**
- Commit changes to your local version:  
`git commit -m "COMMIT_MESSAGE"`  
**`git commit -m "add new author search functionality"`**
- Push a branch of your local version to the remote version:  
`git push -u REMOTE_ALIAS_NAME LOCAL_BRANCH_NAME`  
**`git push -u origin master`**


#### Git GUIs

TODO

### More on Git

The above provides the bare minimum of information.  If you want to know more, you should go through the below pages at [GitRef](http://gitref.org).  Particularly recommended is the 'Staging, Adding, Committing, Etc' section; this will help you understand the `git add .` and `git commit` commands.

- [Creating Repos](http://gitref.org/creating/)
- [Staging, Adding, Committing, Etc](http://gitref.org/basic/)
- [Branching/Merging/Etc](http://gitref.org/branching/)
- [Remote Repos](http://gitref.org/remotes/)
- [Inspecting and Comparing Repos](http://gitref.org/inspect/)

