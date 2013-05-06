core = 7.x
api = 2

projects[] = drupal

; CONTRIB MODULES
; basic modules
projects[entity][subdir] = "contrib"
projects[entityreference][subdir] = "contrib"
projects[admin_menu][subdir] = "contrib"
projects[ctools][subdir] = "contrib"
projects[views][subdir] = "contrib"
projects[features][subdir] = "contrib"
projects[strongarm][subdir] = "contrib"
projects[token][subdir] = "contrib"
projects[wysiwyg][subdir] = "contrib"
projects[wysiwyg_filter][subdir] = "contrib"
projects[menu_block][subdir] = "contrib"
projects[pathauto][subdir] = "contrib"
projects[redirect][subdir] = "contrib"
projects[globalredirect][subdir] = "contrib"
projects[references][subdir] = "contrib"
projects[libraries][subdir] = "contrib"
projects[variable][subdir] = "contrib"
projects[media][subdir] = "contrib"
projects[media_youtube][subdir] = "contrib"

; fields
projects[date][subdir] = "contrib"
projects[link][subdir] = "contrib"
projects[email][subdir] = "contrib"
projects[field_group][subdir] = "contrib"

; common
projects[panels][subdir] = "contrib"
projects[panels_everywhere][subdir] = "contrib"
projects[panelizer][subdir] = "contrib"
projects[menu_block][subdir] = "contrib"
projects[taxonomy_menu][subdir] = "contrib"
projects[webform][subdir] = "contrib"
projects[content_menu][subdir] = "contrib"

; i18n
projects[i18n][subdir] = "contrib"
projects[entity_translation][subdir] = "contrib"
projects[title][subdir] = "contrib"
projects[transliteration][subdir] = "contrib"

; developer modules
projects[devel][subdir] = "contrib"
projects[devel_themer][subdir] = "contrib"
projects[diff][subdir] = "contrib"
projects[module_filter][subdir] = "contrib"
projects[examples][subdir] = "contrib"
projects[design][subdir] = "contrib"
projects[backup_migrate][subdir] = "contrib"

; theming related modules
projects[ds][subdir] = "contrib"
projects[fences][subdir] = "contrib"
projects[breakpoints][subdir] = "contrib"
projects[picture][subdir] = "contrib"
projects[views_slideshow][subdir] = "contrib"
projects[nice_menus][subdir] = "contrib"



; LIBRARIES:
; CKEditor
libraries[ckeditor][download][type]= "get"
libraries[ckeditor][download][url] = "http://download.cksource.com/CKEditor/CKEditor/CKEditor%204.1.1/ckeditor_4.1.1_standard.zip"
libraries[ckeditor][directory_name] = "ckeditor"
libraries[ckeditor][destination] = "libraries"

; THEMES
projects[] = zen
projects[] = mothership
projects[] = omega
