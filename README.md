## Hippocampome Development Model

Source code for all aspects of the Hippocampome project is maintained on GitHub under the "hippocampome" [organization account](https://github.com/blog/674-introducing-organizations) (this is distinct from a personal account).  Individual repositories under this account are accessible using the URL scheme `http://github.com/REPOSITORY_NAME`.  These repositories are public-- anyone can read from them.

A repository is maintained on Github for each aspect of the project.  At present the only repository is 'php', which contains PHP portal code.  Eventually the database import code will be added.  A 'wrapper' repository named 'hippocampome' that contains the others as submodules may also be added at some point.

Individual developers that wish to work on an aspect of the project need to create a Github account.  Once the Github account is created, that account must be [added as a collaborator]() to the central hippocampome account.  This will enable the holder of the new account to write ('push') to repositories under the hippocampome account.

### Production, Development, Review

The Hippocampome 'php' repository contains three branches-- "dev", "rev", and "master" (production).  These branches are permanent.  When bugs are being fixed or new features are being added, the dev branch (or an experimental branch off of the dev branch) should be checked out.  When the dev branch is stable, it can be merged with the rev branch; when the rev branch is stable, it can be merged with master.

There should be no need for most developers to interact with the PHP code on the hippocampome.org server.  The maintainer (David?) can log on to the server whenever a new release is going to occur, navigate to the appropriate site, and run `git pull` to pull down the new version from Github.  Presumably, on the hippocampome.org server there will be three identical versions of the php repository-- the difference between them will be that production, review, and development versions of the site are checking out the master, rev, and dev branches respectively.

## Tutorial

### Getting Started with Git and Github

- Create a Github account [here](https://github.com)
- Follow the download link and instructions [here](https://help.github.com/articles/set-up-git).  If you're on Mac or Linux, you probably don't need to download as Git should already be installed.
- Git can be used from either the command line or various GUIs. Github provides free GUIs for all platforms.  If you use the command line on Windows, you need to use the "git bash" utility that comes with git, instead of the Windows command prompt.

### Getting Started Working on Portal PHP (Command Line)

- Let David know your Github username so he can add you as a collaborator on the php project.  This will let you write ('push') to the Hippocampome repos.
- Navigate to the directory where you want to store the repository (which is itself a directory)  
`cd path/to/where/I/want/my/repo`
- Clone (copy) the repository from Github to your machine
`git clone https://github.com/hippocampome/php.git`

- This will create a repository with several entities:
    - a reference to the remote repo, which is called 'origin' and points to the above URL
    - "remote-tracking branches" for each branch of the remote php repo: origin/master, origin/rev, and origin/dev
    - one local branch called 'master', currently checked out, that is set up to track origin/master.  This means that, when the 'master' branch is checked out, `git pull` and `git fetch` commands are executed relative to the origin/master branch.
- Now create a new branch called 'dev' that tracks origin/dev
**git checkout --track origin/dev**
- This is now the active branch.  This is where you should do all your work-- you should not checkout the rev or master branch.

Once you have made some changes that you are ready to commit to the dev site:

- Stage your changes to be committed to your local dev branch  
**`git add .`**
- Commit the changes to your local dev branch  
**`git commit -m "COMMIT MESSAGE HERE"`**
- Push the changes up to the github version of the dev branch  
**`git push`**

In order for `git push` to work here, you must be added as a collaborator on the Hippocampome Github account.  That's because you'll be actually writing to the account's php repo.

## Git and Github

Git is a distributed version control system (DVCS).  The "distributed" part means that, for a given project, there is no central repository (repo)-- just one or more peer repos, which may be stored on any computer.  Github is merely one more place for repos to live that provides a nice interface to the repositories and that can be accessed from any computer on the Internet.

### Git Repositories

A git repo is a directory that contains a working copy of all of a project's files as well as their history.  The history can be navigated so as to change the set of files that are 'checked out' (the working copies).  The checked out files can be viewed and manipulated like any files on the filesystem.  The rest of the history is stored in a compressed form in the '.git' subdirectory of the root repo directory.

A repo may contain references to one or more remote repos that are other versions of the same project.  These references consist of an alias (frequently 'origin') and a URL.  This reference is used to pull updates from and push updates to the remote repo.  By keeping one 'hub' version of a repo at a central source (i.e. GitHub) and having developers maintain their own local versions of that repo that contain references to the hub, collaboration is greatly facilitated.

 More on repositories [here]().

### Git Branches

Git repositories contain entities called branches that are just what they sound like: different versions of a codebase contained within the same repository, "branching" off of a shared trunk (the code the branches hold in common).  New branches may be created, deleted, or merged with other branches at any time.  When merging, git intelligently recognizing differences between the two branches and, in most cases, automatically resolves those differences (by interleaving the lines of the two versions of a given file).  In some cases it's not able to do this (because the same line has been changed in the two versions) and git alerts you that there are merge conflicts, which must be manually resolved.

Experimental, short-lived branches might be created when a developer decides to add a new feature.  These branches will be merged back into a main branch (often called 'master') when the changes are stable, and the experimental branch deleted.  A project might also contain several permanent or long-term branches.

Each branch corresponds to a particular version of a project.  When working on the project, one and only one branch is active at a given time.  This branch can be chosen with the `git checkout` command.  This command will actually change the representation of the project on the filesystem-- i.e. if you are looking at the project folder in Windows Explorer or OS X Finder and you use `checkout` to switch branches, you may actually see the contents of the folder change.  Don't worry, the old contents still exist, and you can switch back to them with `checkout`.

More on branches [here]().

### Git Command Line

Command line git is a command suite, which means that you run commands in the general form `git COMMAND`.  `git` is a prefix for everything you do.

To use Git from the command line, you'll typically (unless cloning or initializing a new repo) need to navigate to the root of your project (i.e. be in the directory that contains the '.git' directory).  Once there, you can run a variety of commands which are executed relative to that project.

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


### Git GUIs

TODO

### More on Git

The above provides the bare minimum of information.  If you want to know more, you should go through the below pages at [GitRef](http://gitref.org).  Particularly recommended is the 'Staging, Adding, Committing, Etc' section; this will help you understand the `git add .` and `git commit` commands.

- [Creating Repos](http://gitref.org/creating/)
- [Staging, Adding, Committing, Etc](http://gitref.org/basic/)
- [Branching/Merging/Etc](http://gitref.org/branching/)
- [Remote Repos](http://gitref.org/remotes/)
- [Inspecting and Comparing Repos](http://gitref.org/inspect/)

[Here](http://git-scm.com/book/en/Git-Branching-Remote-Branches) is a much more in-depth look at the mechanics of remotes and branching
