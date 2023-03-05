<p align="center"><img src="logo.png"  width="400"></p>

# POD

POD (placement online diary) is an application to allow students to keep track of their placement year.

## Overview
POD is a website that makes life easier for students on their year in industry, it does this by allowing users to to keep a detailed record of what happens during their YII, they can then refer back to this information when creating CV's and end of year reports etc

### Entries
The way in which users recount information into the website is through the use of 'entries', the user can create as many entries as they like and each entry can be formed from a single 'template'

### Templates
When creating an entry, a user selects a certain template to use. This template contains a pre-defined set of inputs for the user to fill in, some examples of templates are...

- General: For creating a general diary entry
- Training: For when the user has completed some training
- New skill: For when the user learns a new skill

say the user selects the "New skill" template, they would be presented with inputs to fill in related to learning a new skill, these would include...

- The name of the skill they learned (text input)
- The date they learned that skill (date input)
- Details on what they learned or how they learned the skill (text-area input)

### Template schema
When developing a new template a few criteria must be met in order for it to work correctly with the application, Templates are stored in MongoDB to allow them to have flexible schemas.

#### Format
Templates are stored as JSON, for example, the "General" template is defined as follows...
```json
{
  "_id": {
    "$oid": "63fb3b3a0a0c8ed50908f892"
  },
  "name": "General",
  "description": "A normal diary entry",
  "icon": "general.svg",
  "fields": [
    {
      "id": "title",
      "label": "Entry title",
      "type": "text",
      "required": true,
      "validation": [
        "required",
        "max:100"
      ]
    },
    {
      "id": "date",
      "label": "Date",
      "type": "date",
      "required": true,
      "validation": [
        "required",
        "date"
      ]
    },
    {
      "id": "content",
      "label": "Entry content",
      "type": "textarea",
      "required": true,
      "validation": [
        "required",
        "max:3000"
      ]
    }
  ],
  "updated_at": {
    "$date": {
      "$numberLong": "1677409082055"
    }
  },
  "created_at": {
    "$date": {
      "$numberLong": "1677409082055"
    }
  }
}
```
#### Essential attributes
Templates contain the following top level attributes...

|   Key |   Description | Type | Required? |
|---|---|---|---|
| _id | A unique identifier for this template, this should be automatically generated by MongoDB | Int | yes |
| name | A string representing the name of the template | String | yes |
| icon | The filename of the icon for this template (this needs to be stored in the applications */assets/images/templates* folder) | String | no |
| description | A string representing the description of the template | String | yes |
| fields | An array of the fields this template contains | Array | yes |


#### Fields
Fields is an array of the inputs this template will provide for the user. This array **MUST** have a field with an id of **title**

```json
"fields": [
  {
    "id": "title",
    "label": "Entry title",
    "type": "text",
    "required": true,
    "validation": [
      "required",
      "max:100"
    ]
  }
```

and each field consists of the following options

|   Key |   Description | Type | Options |  Required? |
|---|---|---|---|---|
| id | A unique identifier for this field | String | | yes |
| label | What the user sees on the screen when filling in this input | String |  | yes |
| type | What type of input this is, these must be implemented in the application, currently there are a few built in | String | text, date, textarea | yes |
| required | Is this input required? (used for front end validation) | Boolean | true, false | no |
| validation | An array of validation rules used to validate this input on the back-end | Array | A list of Laravel validaion rules can be found [here](https://laravel.com/docs/10.x/validation#available-validation-rules) | yes |

### Features

An important part of the project is measuring the most effective gamification techniques in online diary applications, these gamification techniques are implemented as **features** in the application.

Some examples of features include...

- A *leader-board* to view the status of other students
- A *streak* of the number of consecutive entries made by the user

These features can then be grouped together to create a series of gamification features for different users.

#### Feature groups

As mentioned above, these features can be grouped together, these are known as **feature-groups** a feature group contains a number of users and a number of features.

Users are then randomly assigned into a feature group when they sign up for the site.

#### Feedback

The results from the experiment are then drawn from the users feedback of their *version* of the application. This will hopefully indicate the most effective forms of gamification.


## Tech Stack

**Client:** Vue.js, InertiaJS, TailwindCSS

**Server:** PHP (Laravel framework)

**Database:** MYSQL, MongoDB


## Run Locally

Clone the project

```bash
git clone git@github.com:angus-websites/pod.git
```

Go to the project directory

```bash
cd pod
```

Setup Laravel Sail

**_NOTE:_**  Ensure you have Docker installed

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Generate a .env file

```bash
cp .env.example .env
```
Run Laravel Sail (Development server)

```bash
./vendor/bin/sail up
```

**Open a new Terminal tab in the same project root folder**

Generate an app encryption key

```bash
./vendor/bin/sail php artisan key:generate
```

Migrate the database

```bash
./vendor/bin/sail php artisan migrate
```

Seed the database tables

```bash
./vendor/bin/sail php artisan db:seed
```

Install npm dependencies

```bash
./vendor/bin/sail npm install
```

Run Vite

```bash
./vendor/bin/sail npm run dev
```

Visit [Localhost](http://localhost/)

## Tips

When updating certain fields in the `.env` file when using Laravel Sail, you may need to restart the Docker container for changes to take affect.

## Demo

A live version of POD is available [here](http://pod.angusgoody.com/)

## Authors

- [@angusgoody](https://github.com/angusgoody)

