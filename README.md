#PHP 8.1 version
#DB Name: - tailwebs
#Project Name:-  tailwebs
#Local Check:- http://127.0.0.1:8000

Flow: 
1. Once you Download application in your local xampp folder
2. Then extract it and run composer update
3. Run below command to migrate data on Db
   1. php artisan migrate
   2. it will pull all tables. if it not create holiday table,Then please use these command to create Holiday table
      1. php artisan make:migration create_sudents_table
      2.  Add on up function on holiday migration db
            $table->id();
            $table->string('name');
            $table->text('subject_name')
            $table->integer('marks');           
            $table->softDeletes();
            $table->timestamps()
5. Run php artisan serv
6. On browser run http://127.0.0.1:8000 this url
7. Registration and Login as per informed
8. After login with email and password,it will redirect to home screen.
9. On Home screen you can see list of students with pagination.
10. 1. Add student as popup
    2. Taken care all steps to student and subject related points
    3. Added authentication,if un-autharize then it will redirect to login screen.
11. update as inline in table has done to update marks

git remote add origin https://github.com/sunilkulkarni332/tailwebs.git
git branch -M main
git push -u origin main