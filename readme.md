# OJS/OMP Zenon-Plugin

Provides a public identifier zenonID in OJS/OMP systems.

Branches:
 * master: ojs2
 * ojs3
 * omp3

## installation

    git clone https://github.com/dainst/ojs-zenon-plugin.git /ojsomppath/plugins/pubIds/zenon    
    
## usage

The activated plugin provides a text-input field inside the metadata modal. One can open the modal by clicking on "metadata"  on the top right (providing that the theme in use put it there) of every submitted article. Inside the opened modal there is a second tab labeld as identifier under which one can enter every activated additional public identifier. 

The parent-template is `templates/controllers/grid/pubIds/form/assignPublicIdentifiersForm.tpl`
Here the call goes to `getPubIdAssignFile()` which returns the plugin form.

The entered Zenon Id will be shown as a Link to the Zenon-entry on the articles page in the right column in the block labeld zenonId. 
