# PDFire

PDFire is a lumen application that can split and isolate any PDF file and extract only the needed parts.

## Installation

No installation needed, but is tested via the console command that follows :

```bash
php -S localhost:8000 -t public
```

## Usage
### Exctraction
To extract page 3 to 6 from a previously uploaded file named 
```javascript
{
  "fileName" : "file_name",
  "firstPage" : 3,
  "lastPage" : 6
}
```
### Merge
To merge the pages that have been extracted into a file named fused_file_name.pdf, only specify final file name of fused pages.
```javascript
{
  "polyName" : "fused_file_name",
}
```
### File upload
To upload a file just specify the file and it'll upload it into the correct folder
```javascript
{
  "fileName" : "file_name",
  "firstPage" : 3,
  "lastPage" : 6
}
```
### 

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)