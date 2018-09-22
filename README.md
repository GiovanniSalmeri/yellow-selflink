# Selflink plugin 0.7.6

Create internal links. (Similar in function to the tag `cms_selfink` in CMSMadeSimple.)

## How to install plugin

1. [Download and install Datenstrom Yellow](https://github.com/datenstrom/yellow/).
2. [Download plugin](../../archive/master.zip). If you are using Safari, right click and select 'Download file as'.
3. Copy `master.zip` into your `system/plugins` folder.

To uninstall delete the [plugin files](update.ini).

## How to create an internal link

Create an `[a]` shortcut. 

The following two arguments are available, the second of which is optional:

`slug` = the slug of the page to link    
`text` = the text to be used in the link  

## Example

Creating a link:

`[a somepage]`  
`[a somepage - text for linking]`  

The shortcut creates a link regardless of the path of the page. The previous examples are thus equivalent to:

`[Title of the page](path/to/somepage)`  
`[text for linking](path/to/somepage)`  

If you need to distinguish between two or more pages with the same slug, you can specify the portion of the path which is sufficient to disambiguate:

`[a path/to/somepage]`  
`[a anotherpath/to/somepage]`  

If the argument of the shortcut is ambiguous, the behaviour is undefined. If no page matches the argument, the shortcut creates a link equivalent to this HTML code:

`<a href="slug" class="missing">slug</a>`  

## Developer

Giovanni Salmeri
