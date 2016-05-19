# RosenfeldMinecraft

A simple status page for my [Minecraft server](https://minecraft.rosenfeld.xyz)

## Requirements

- PHP 5.5+
- Composer
- NPM

## Setup

Make sure you have the minimum requirements and install dependencies.

```bash
$ composer install
$ npm install
```

Configure the application in `config.ini`. Add the Minecraft servers you would like to keep track of.

```ini
[info]
title = Your title
description = Your description

[hosts]
your.domain.here = port
```

Launch the application and navigate to it in your web browser.
