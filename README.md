# measurement conversion
Converts distance, volume, mass, speed, and temperatures from one format to several others

# Project Overview

During a PHP Development course, I was asked to create an online tool that converts measurements from one format to another. The tool would need to handle items such as length or distance, area, volume and capacity, mass and weight, speed, and temperature. 

Beginning with length and distance measurements seemed like a great starting point that would drive the design decisions. Length and Distance are both terms that describe a measurement between two points. One could note that height, width, as well as depth are also considered length measurements. These measurements, though, also provide details regarding the orientations of the lengths of an object. 

This is not always so cut and dry. Length or distance measurements come in many different flavors depending on geographical location or even context. The easiest starting point was determining some common units of measuring lengths.

1. Imperial system of measurement
  a. inch, foot, yard, mile

2. Metric
  a. millimeter, centimeter, meter, kilometer

While there are many other systems for measuring length or distance out there, such as the maritime measurements of a fathom, cable, nautical mile, or league, the project calls for only the most common types. It's possible that more will be added at a later date.

# The Challenge

There are at least two approaches to the project

1. Maintain formulas to convert each unit to every other possible unit.
  This would come to mean that doing a conversion from miles, for example, to kilometers, one formula would be required.
  To go from x miles to y yards, a second formula would be required.

There are benefits to this approach. Any conversion that is taking place would be done easily in one simple calculation. On the other hand, there would be an ever growing number of formula's to maintain. If there were only 10 length units, the number of formula's necessary to maintain would be equal to (9+8+7+6+5+4+3+2+1) = 45 total formulas to maintain. If a future update required an additional measurement format, making the total length units 11, 55 formulas in total would be required. 12 length units then would require a total of 66 formulas. This appeared to be the most simple approach until one considered future updates. With so many formulas to create and maintain, I foresaw my weekends and spare time fading away before my eyes.

2. Choose 1 and only 1 unit to be a "common" unit for length.
  In this way, only one formula is necessary to be maintained to convert every other unit to the common unit. This common unit would act 
  as something of a bridge between the different units. This same principle can be applied to every category of measurement units that
  is required by the project.
  
With approach number 2, if converting miles to inches, for example, we do not need to maintain a formula that directly converts from miles to inches. Instead, the miles unit would be converted to meters and then the conversion from meters to inches would take place.

This means that for 10 length units, only 9 formulas are required. Of course, it is not necessary to convert meters to meters. Only the other 9 units would require conversion. This is why there would only be 9 formulas as opposed to 10.

In this way, if a future update required additional units of measure to be added, - only one - formula per unit would be necessary.

On the other end of the spectrum, with approach number 2, we're performing multiple calculations within the code instead of just one.
- The calculations performed by PHP7 are very fast.
- The conceptual simplicity, reduction in work load and time spent maintaining the formulas and less code make this a worthwhile trade-off.

The next question to arise was which unit to use as a common unit. After much consideration, it was determined that the common unit should be Meters / Metres. Meters are an international standard for length, otherwise known as the SI unit. Due to this fact, it was decided that it would be a great unit to begin the length conversion portion of the project with. 

# Fun Fact

Most English speaking countries spell it Metres, while those in the United States spell it Meters. As I live in the United States, this is the spelling I chose to use in my code. 

# The Approach

With the project blue prints neatly organized and the approach settled on option 2, It was time to roll out out the plan of action. For each unit of measurement, a common unit would be required

- Length and distance: Meters
- Volume and capacity: Liter
- Mass and weight: Kilogram

The project is small and tightknit, as such, defining a class or multiple classes is not a necessity. 

Functional programming would be acceptable, and due to a deadline, is recommended. May be modified to use Object Oriented Design later.

Use Bootstrap 4 CSS framework for the front-end design. As the deadline looms, no need to worry too much about the look and feel.

The project is to be done using PHP. jQuery or JavaScript usage is optional.

I wanted the final project to look close to the conversion calculator found on <a href="https://www.google.com/search?sxsrf=ALeKk02yMSXoA6FrTHJd-_1B_uWdZgHx-w%3A1592765684913&source=hp&ei=9KzvXpTfNY_btAaMgLi4Cw&q=length+conversion&oq=length+conversion&gs_lcp=CgZwc3ktYWIQAzIKCAAQsQMQFBCHAjICCAAyAggAMgIIADICCAAyAggAMgIIADICCAAyAggAMgIIADoECCMQJzoFCAAQkQI6BQgAELEDOgUIABCDAToHCAAQFBCHAjoICAAQsQMQkQJQpRVY3CRgrCdoAHAAeACAAUmIAYAIkgECMTeYAQCgAQGqAQdnd3Mtd2l6&sclient=psy-ab&ved=0ahUKEwiUqe7GypPqAhWPLc0KHQwADrcQ4dUDCAk&uact=5" target="_blank">google.com</a>.

