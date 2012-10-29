<?php

// Will import tags predefined in the external file into the 
// array passed into this function.
//
// Rules for tags from tag file:
//   - Plain text file with one tag per line
//   - Any duplicates will be removed during import
//   - Leading and trailing spaces will be removed during import
//   - A tag can consist of single or multiple words separated by spaces or hyphens
//   - Spaces between words will be replaced with hyphens during import
//
function qa_import_predefined_tags(&$existing_tags)
{
	$file = fopen(QA_EXTERNAL_DIR . "tags.txt", "r");

	if($file)
	{
		// Read-in file line-by-line
		// Import and cleanup/format the tags as we go along
		while(!feof($file))
		{
			$tag = utf8_encode(fgets($file));	//utf8_encode to deal with accented characters
			
			if($tag)
			{
				$new_key = trim($tag);							// Strip whitespace from start and end of string
				$new_key = mb_strtoupper($new_key, 'UTF-8');	// Convert to upper-case.  mb_strtoupper deals with UTF-8 encoding
				$new_key = str_replace(" ", "-", $new_key);		// Hyphenate multi-word keys
	
				// Add new tag (key)
				// This also handily deals with ignoring possible duplicates
				//
				$imported_tags[$new_key] = 1;
			}
		}

		// If we got some imported tags, merge them into the existing tags passed into this function
		// otherwise we don't touch the existing tags array
	    if (!empty($imported_tags)) 
		{
			// We need the existing tags to be in upper case in order to ensure 
			// that we avoid any possible duplicates 
			$existing_tags = array_change_key_case($existing_tags, CASE_UPPER);
			$existing_tags = array_merge($existing_tags, $imported_tags);
	    } 
	}
}


