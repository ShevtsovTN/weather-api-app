<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Weather-Api-Test-Project

### The Goal

Create a CRUD API for Weather Forecast Model, run cron jobs and setup queue Jobs and setup basic unit Testing.

The overall goal is to showcase the ability to write well optimized Laravel apps with some complexity.

---

### Task Details

Create a Weather Forecast Model to store the weather forecast from a 3ed party vendor.

Create an API to pull the Weather Forecast for the inputted Date.
If the selected Date is not in the database, pull it in from the Weather API.
If data for the Date is not available in the Weather API return an error.

When pulling, storing and returning the data get/store/return results for all of the following locations:

- New York
- London
- Paris
- Berlin
- Tokyo

4 Times a day,  pull/store/update Weather API results for that day.

Notes:

- Use Jobs at least once
- Use Events at least once - (I didn’t figure out what to attach the event to.)
- For Weather API use [https://openweathermap.org/api](https://openweathermap.org/api) or similar - (The free version of the API does not allow getting data for a date other than the current one.)
