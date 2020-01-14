# Selflink extension 0.8.9

Create internal links.

## How to install extension

1. [Download and install Datenstrom Yellow](https://github.com/datenstrom/yellow/).
2. [Download extension](../../archive/master.zip). If you are using Safari, right click and select 'Download file as'.
3. Copy `master.zip` into your `system/extension` folder.

To uninstall delete the [extension files](extension.ini).

## How to create an internal link

Create an `[a]` shortcut. 

The following two arguments are available, the second of which is optional:

`slug` = the slug of the page to link    
`text` = the text to be used in the link  

## Example

Creating a link:

`[a somepage]`  
`[a somepage - text for linking]`  

The shortcut creates a link with the full path of the page: so no link will break if you rearrange the structure of the site without modifying the slugs of the pages. The previous examples are thus equivalent to:

`[Title of the page](path/to/somepage)`  
`[text for linking](path/to/somepage)`  

But if two or more pages have with the same slug (which in general is not advisable), you must specify the portion of the path which is sufficient to disambiguate:

`[a path/to/somepage]`  
`[a anotherpath/to/somepage]`  

If the argument of the shortcut is ambiguous, the behaviour is undefined.

If no page matches the argument, the shortcut creates a link equivalent to this HTML code:

`<a href="slug" class="missing">slug</a>`  

(All this is functionally similar to the tag `cms_selfink` in CMSMadeSimple.)

## Developer

Giovanni Salmeri
