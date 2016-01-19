# partEZ

## Running partEZ
### Composer
Laravel uses the dependency manager Composer so make sure that you have it installed on your maching. 
https://getcomposer.org/

### Vagrant
Vagrant provides a simple, elegant way to manage and provision Virtual Machines. Use Vagrant to run Laravel's homestead, a virtual machine that contains everything you need for Laravel developmet. 
https://www.vagrantup.com/

### Running the project
Once you have downloaded the project, navigate composer into the project's root folder and type:

php artisan serve

Open your browser to http://localhost:8000/ to see the partEZ homepage. 

## Development
The best way to compile the project is through homestead. 
Create a Code in your User folder (C:\Users\user\Code).
Download and extract the project into the Code folder. 
Navagate to the project folder in Composer. Run:

vagrant up

SSH into homestead using Terminal or Git Bash(Windows). Run:

vagrant ssh

Your Code folder is shared with homestead. Use homesteadd to install new packages since it comes prepackages with everything you need for Laravel developemnt and your changes will appear in your Code folder. 