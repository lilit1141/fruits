# Fruits Management


## Requirments
  - **Apache**
    - [Windows](https://pureinfotech.com/install-xampp-windows-10/) - XAMPP
    - [Mac](https://documentation.mamp.info/en/MAMP-Mac/Installation/) - MAMP
    - [Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04) - LAMP
  - **PHP 8.1**
  - **MYSQL**
  - **Composer**
    - [All OS](https://getcomposer.org/download/)
  - **Node 16.0+**
    - [Windows](https://phoenixnap.com/kb/install-node-js-npm-on-windows)
    - [Mac](https://www.webucator.com/how-to/how-install-nodejs-on-mac.cfm)
    - [Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-ubuntu-18-04)

## INSTALLATION

Clone the project from github




  - create `.env` file
  - copy content from `env.example` to `.env`
  - configure `env` according to your settings
  

  - Open the file config/db.php and change the parameters to be correct for your database.


  - run following commands
      ```shell script
       composer install 
       php yii migrate
      ```

        
  - install packages
    ```shell
     npm i
    ```  

  - Compile assets in development:

    ```
    yarn mix
    ```
    
  - Watch assets changes
  
    ```
    yarn watch
    ```
    
