# CodeDocs Plugin for PlantUML

This plugin uses [PlantUML](http://plantuml.com/) to generate UML diagrams.

## Installation

Execute `composer require christianblos/codedocs-plugin-plantuml`.

Add this plugin to your **codedocs.yaml** file:

```yaml
plugins:
  - \CodeDocs\PlantUml
```


## Usage

Create a **puml**-File next to the markdown files.

```
docs
 |- example.md
 |- diagram.puml
```

diagram.puml:

```
@startuml

A -> B

@enduml
```


Use the **PlantUml-Markup** to show this diagram.

example.md:

```md
{@PlantUml("diagram")}
```
