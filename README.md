# Role & Permissions GUI for laravel

This package add GUI in admin area  for CRUD roles,permissions and assign permissions to role

 
### Installing

For install package you shoud run commands in terminal

```
composer require nick-kh/larapack-role-permissions
```

Run migration to create permission table

```
php artisan migrate
```


Run seed to insert permissions to permission table

```
php artisan db:seed --class=\LaraPack\RolePermission\seed\PermissionsTableSeed
```


Publish assets, It will publish app.role.js file in  public/admin/js folder

```
php artisan vendor:publish --tag=assets
```
 
 
Add menu in sidebar.blade.php file where you want to show  "Roles & Permissions" section

```
 @if (Auth::user()->hasRoles('admin'))
                <li class="{{ isCurrentRoute(['admin.role','admin.permission','admin.assign-permission']) }} treeview ">
                    <a href="#"><i class="fa fa-cogs"></i> <span>Roles & Permissions</span></a>
                    <ul class="treeview-menu ">

                        <li class="{{ isCurrentRoute('admin.role') }}">
                            <a href="{{route('admin.role.index')}}"><i class="fa fa-circle-o"></i><span>Role</span></a>
                        </li>
                        <li class="{{ isCurrentRoute('admin.permission') }}">
                            <a href="{{route('admin.permission.index')}}"><i class="fa fa-circle-o"></i><span>Permission</span></a>
                        </li>

                        <li class="{{ isCurrentRoute('admin.assign-permission') }}">
                            <a href="{{route('admin.assign-permission.index')}}"><i class="fa fa-circle-o"></i><span>Assign Permission</span></a>
                        </li>

                    </ul>
                </li>
            @endif
```
  
 

 
## Authors

* **Nick Kharadze** - [Bossman1](https://github.com/Bossman1)
 
## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
