# Selflink extension 0.8.16

Create internal links.

## Deprecation

**This extension is deprecated in favour of [Link](https://github.com/GiovanniSalmeri/yellow-link). In order to transform the Selflink shortcuts into the new Link shortcuts, do the following:**

- Make a backup copy of the `/content/` folder
- Install [Link](https://github.com/GiovanniSalmeri/yellow-link) extension
- Download file [selflinkpatch.php](https://raw.githubusercontent.com/GiovanniSalmeri/yellow-selflink/master/selflinkpatch.php) 
- If you do not want also the generic Markdwown links to be changed into Link shortcuts, delete in `selflinkpatch.php` lines 24-25
- Copy `selflinkpatch.php` into the `/system/extensions/` folder
- Visit the site with the browser

## How to create an internal link

Create an `[a]` shortcut. 

The following two arguments are available, the second of which is optional:

`slug` = the slug of the page to link, possibly with the fragment  
`text` = the text to be used in the link  

## Example

Creating a link:

```
[a somepage]  
[a somepage#fragment]  
[a somepage - text for linking]  
```

The shortcut creates a link with the full path of the page: so no link will break if you rearrange the structure of the site without modifying the slugs of the pages. The previous examples are thus equivalent to:

```
[Title of the page](path/to/somepage)  
[text for linking](path/to/somepage)  
```

But if two or more pages have with the same slug (which in general is not advisable), you must specify the portion of the path which is sufficient to disambiguate:

```
[a path/to/somepage]  
[a anotherpath/to/somepage]  
```

If the argument of the shortcut is ambiguous, the behaviour is undefined.

If no page matches the argument, the shortcut creates a link equivalent to this HTML code:

```
<a href="slug" class="missing">slug</a>  
```

## Installation

[Download extension](https://github.com/GiovanniSalmeri/yellow-selflink/archive/master.zip) and copy zip file into your `system/extensions` folder. Right click if you use Safari.

## Developer

Giovanni Salmeri. [Get help](https://github.com/GiovanniSalmeri/yellow-selflink/issues).
