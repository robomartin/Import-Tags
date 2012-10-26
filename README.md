Import Tags
==========================================================

This code is intended for Question2Answer 1.5.3
http://www.question2answer.org/

The patch allows you to import a set of predefined tags in order to be able to present the user with tag suggestions before questions exists for these tags.

Predefined tags are stored in plain text file "tags.txt" in the "qa-external" directory, along with the php module that does the importing.

Installation
------------------------------------------------------------

Simply install over your existing Question2Answer installation.

This can be done any time after having installed Question2Answer.

The following files are affected:

```
ADDED
<site-root>/qa-external/qa-import-tags.php		
<site-root>/qa-external/tags.txt	
```

```
MODIFIED
<site-root>/qa-include/qa-page-ask.php
<site-root>/qa-include/qa-page-question-post.php
```

What's modified?

This code is added to the above two files:

```php
// ********************** START MODIFICATION *****************************
require_once QA_EXTERNAL_DIR .'qa-import-tags.php';
qa_import_predefined_tags($completetags);
// **********************  END MODIFICATION  *****************************
```

That's it.  If you need to revert back to stock behavior simply delete or comment-out those two lines of code.

Edit "tags.txt" to create your own tag list
