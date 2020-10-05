
/*
\---------------------------------------------------------------------------/
| Inzu API                                                                  |
| ======================                                                    |
|                                                                           |
| Copyright (c) 2012 Inzu.net                                               |
| For contact details, see: http://www.inzu.net                             |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
/---------------------------------------------------------------------------\
*/


FOREWORD

The purpose of this code is to illustrate how an Inzu website can be built using HTML, CSS and PHP. 

All feed types have been included to provide example code, but most websites will not have a page view file for every page or use all feed types. In fact most generic web pages can be shown using the 'Articles' feed. 

Specific page views are useful if a page has a distinct design. For example you may want to create a different page view/design for an events page where essential information is presented in a structured way. Or maybe your blog has a different look and feel to the rest of your site.

You are not limited to having one feed per page view, as can be seen in 'index.php' you can call as many content feeds as you like on one page!



INSTALLATION

1. Upload all files, excluding this 'Read Me' file to the root directory of your website or subdomain.

2. Load the index.php file in your browser.

You should now see content from the Inzu testing environment.



FOLDERS

/lib/core
This folder contains you sites configuration file 'config.php' which is where your API key is copied to. The file 'function.php' contains the sites "Site map", the site map can be used to manage the sites navigation menu.

/template
Contains the files the sites design template.

/lib/css
All the external CSS for the site is located in 'main.css'.

/
The root folder contains all of the sites page views excluding the store.

/store
All the e-commerce files for a regular store, shopping cart and music store are located here.


For more information on the Inzu API and to reference every API feed please visit http://developers.inzu.net
or contact support@inzu.net.