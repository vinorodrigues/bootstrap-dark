# The Definitive&sup1; Guide to Dark Mode and Bootstrap 4
A proof of concept / Longform ~~whitepaper~~ {darkpaper}

Jump to:

*  [About me & The history that led here](#about-me--the-history-that-led-here)
*  [The Philosophy of Dark Mode](#the-general-philosophysup1-of-dark-mode)
*  [The Philosophy of this Proof of Concept](#the-philosophy-of-this-proof-of-concept)
*  [The `*-alt` SCSS includes](#the--alt-scss-includes)
*  [The Variants](#the-variants)
    -  [Bootstrap-Night](#bootstrap-night)
    -  [Bootstrap-Nightfall](#bootstrap-nightfall)
    -  [Bootstrap-Nightshade](#bootstrap-nightshade)
    -  [Bootstrap-Dark](#bootstrap-dark)

## About me & The history that led here

Firstly, I'd like to state that I'm not a professional developer - I was, from about '88 to '05, but that's not what I do now.  I'm an Electrical Engineer and Businessman who manages datacenters and their staff, and design UPS, HVAC and power systems ... that's my day job.  But I still love code.   I code as a hobby and everything I've coded since 2005 I've opensource... somewhere.  I'm also not a "graphics" or "artistic" person - I've no education in design, UI or UX - but I understand it's basic concepts.  I'm also not a long form writer... I'm dyslexic and have a relatively low [Verbal-linguistic Intelligence][1] - so these ramblings may be hard to digest.  My apologies.

None of the content here is original; It's based on logical combination of ideas from many great technology content producers, and I've tried to reference these when I can.  There is also a lot of personal opinions and my own ideas of code philosophy and design positions - these I will mark with an asterisk (&sup1;).  After managing developers for many years, I can safely&sup1; say that if you put 30 developers in a room and ask them to code something, you'd get 30 different ways to get to the same result.  (Tom Scott has a brilliant&sup1; conversation about this in his video about the [*FizzBuzz Test*](https://www.youtube.com/watch?v=QPZ0pIK_wsc).)

That said; my opinions and code path here is just one way to achieve what I though needed to be proved, namely that:

*  Bootstrap, in its current version (4.5.0), can achieve dark mode support
*  by exploring if it can be modified to support native OS (or Browser) dark mode preferences, as made available in '[***prefers-color-scheme***][2]' media query spec.,
*  assume Jamstack (so no server side ... stuff),
*  without modifying the core code,
*  but written in a way that can be pulled into the core (if the authors so want to),
*  and finally, make it so that others can use it if the Authors have another path to this.

I can't remember when I first came across the concept of "dark mode"; must have been sometime in late 2018 when I'd installed Safari Technology Preview and read some reference to the [`prefers-color-scheme`][2] *(still in draft with the W3C)*.  At the time I was attempting to write a (now abandoned) [WordPress theme][3] based on Bootstrap 4 after having written a [Bootstrap 2 based WP theme][4] a few years earlier, and a a bit later a [printing plugin][5] for Bootstrap 3.  I remember thinking that I would love to not only release a highly configurable WordPress theme, but one that supported this wonderful [css-dark-mode][6].  I can vaguely recall looking at the code and deciding "Yea, not doable&sup1;!" and started doing some research on the topic.  But at the time there wasn't much.  I did however come across [issue #27514][7] in the Bootstrap GitHub repository, and also saw [@mdo][100]) close it off.  My thoughts were that if the creator of Bootstrap was not keen on this then it would never happen&sup1; - so I reluctantly gave up on WP-Bootstrap-4 and moved on to other hobbies.

Time passed - I fell out of love with Bootstrap and took on a new mistress&sup1;, Foundation 6.  Spent a lot of time with it, but it is... different... lighter, easier to use because it is simpler, merged awesomely with "your own scss"; but it also doesn't work so well with out-of-the-box inclusion into existing sites - especially if you want to theme it up a bit, and it's not as flexible.  Bootstrap has Thomas Park's ([@thomaspark][101]) [Bootswatch][8] (Why the hell is he not a contributor?&sup1;), that he's [been maintaining][9] for over 6 years now.  But Foundation has nothing - yes Justin Mahar had started one called [Foundswatch][10] in 2018, but he archived that and relinquished the domain name.  The funny thing about Justin's work is that I didn't know of it until after I had created my own variant of [Foundswatch][11], but I digress.  The important takeaway of that side-story is that whilst I was working on it, I explored deeply the topic of Dark Mode again.  I realized that [Bootswatch Flatly][12] and [Bootswatch Darkly][13] are only different in color.  I also came across Thomas Steiner's ([@tomayac][102]) awesome article [*"prefers-color-scheme: Hello darkness, my old friend"*][14] and realised that I could offer a dark-mode option to Foundswatch users. And so, for Foundswatch, I created a [foundation-dark][15] theme that was usable as a two-color scheme CSS (albeit with 2 CSS files) for Foundation 6 and wrote a how to in the [help page][16].

Sadly, I was not satisfied - I wanted a one CSS files solution - and promptly started to modify my own fork of Foundation for Sites.  OMG!  It was very near impossible!  (More on [why](#the--alt-scss-includes) later, but needless to say I gave up on that). Then one recent day I get a notification on my RSS reader that Bootstrap 4.5.0 was out ... "hello my old love" I thought and did the pulling and reading and the revisiting of issues pertaining to "*dark mode*".  My old friend [#27514][7] was now active, and then there was a bunch of them including:

*  One with an actual effort, albeit only for [dark mode for the docs](https://github.com/twbs/bootstrap/pull/28449)
*  [Precompiled dark version #28424](https://github.com/twbs/bootstrap/issues/28424)
*  [Docs dark mode #28449](https://github.com/twbs/bootstrap/pull/28449) - (seems to be working, albeit only for dark mode on the docs.)
*  [Bootstrap Dark Mode #28540](https://github.com/twbs/bootstrap/issues/28540)
*  [Feature Request: Dark Mode #28754](https://github.com/twbs/bootstrap/issues/28754)
*  and some work by [@Carl-Hugo][103]), in his project [ForEvolve/bootstrap-dark][17]. He has a working Bootstrap 4 dark theme, but that's stand-alone theme and did not meet my needs, i.e. support for user preferred dark-mode.
*  I even found a blog entry on [@mdo][100])'s blog [*"CSS dark mode"*][37]

But nowhere did I see an attempt at creating a true dark mode - in the core.  I did notice my old friend [#27514][7] was marked for V6.  V6!!! I can't wait that long&sup1;!

So, I set out to prove that one can achieve true dark-mode support.


## The (General) Philosophy&sup1; of Dark Mode

Before I set out to discuss how I went about coding this I thought it prudent to explore why dark mode is even a thing.  I could not find a definitive guide on ***why*** dark mode.  The history seems assumed - The UX Collective article [*"The past, present, and future of Dark Mode"*][19] that covers the origins from CRT screens - but goes on to reference experiments and studies done with light-on-dark vs. dark-on-light and how a bunch of them showed that darker UI was "more productive".  Wired's Will Bedingfield wrote in [*"How dark mode took over our screens"*][20] how companies like Apple, Microsoft, Google and Twitter are all in on the dark mode train.  Chris Taylor wrote in Mashable [*"Why 2019 was the year of Dark Mode"*][21] how the push for dark mode has become more prominent in recent times (late 2019, early 2020).  There are also umpteenth articles on the benefits of dark mode, like Reeno Koemets in [*"The Benefits of Dark Mode: Why should you turn off the lights?"*][22], and even some against it, like Adamya Sharma's [*"Love dark mode? Here's why you may still want to avoid it"*][23], but the general consensus is that if you're not offering your websites and web-apps in dark mode that you're literally standing out - in a negative way.

So, it thus confounds me, as to why the Bootstrap Authors are not looking at this with more haste and urgency.


## The Philosophy of this Proof of Concept

I mentioned before [@Carl-Hugo][103]'s [boostrap-dark][17] theme already produces a dark variant of Bootstrap and, combined with the approach Thomas Steiner ([@tomayac][102]) [suggests][14], one can certainly achieve dark mode today - though I've not seen those two bodies of work linked.

But the 2-CSS file approach - though very legitimate and very usable - has a flaw if not used correctly.  Support for older browsers - specifically the fact that, in older browsers like IE11, they will load both CSS and neither will render.  You'll need additional JavaScript code to inject a non-media filtered CSS ... not a bad thing, but it makes drop-in replacement of existing sites using Bootstrap needing some level of code modification - some easy, some harder (think WordPress themes).

On the plus side this approach is about the only one that gives you true flexibility.  You can for example use 3rd party styling (like Bootswatch Flatly and Darkly) to generate the same effect.  This is way more flexible.

In my opinion what's ideal is a single CSS Bootstrap variant&sup1; that does dark mode for browsers that support it, but also works in all supported browsers.

There is a bunch of conversation from the core authors around support for dark mode based on CSS variables and that their only concern was IE11 and that by the time they get to dark mode then they'd drop support for IE11.  All fine and dandy, but it's not only IE11 that does not support dark mode, as in the [prefers-color-scheme media query][23], and [CSS variables][24].  There is also a bunch of older mobile devices still in use that cannot be upgraded, for example older iPad that cannot upgrade further than iOS 12.4 and Safari 12.1.  One cannot forget that only 58% of used browsers (based on the sum of top 10 browsers supporting it, from [*"Browser & Platform Market Share April 2020"*][25]) support dark mode today - so it makes sense that the Authors want to wait on this.

Back to thinking about @[Carl-Hugo][103]'s work been adapted to work with dark mode - if one applies the coding practice that one should never write the same piece of code twice, there is a whole bunch CSS that gets repeated *(not that that code got written twice - but that principle applies both to writing and the consumption of memory when run)* ... comparing the two CSS files to each other there is a bunch of duplication except in elements of color.

Generally speaking, if you look at CSS there are 3 core concepts:

*  Geography - or layout.  Things like spacing, sizes, `padding`, `margin`, `height`, `width`, and even concepts like column counts.
*  Type Faces - Font families, styles, weights, decoration etc.
*  and, Color - `color`, `background`, and the complication of elements that have both geography and color, like `border` and `shadow`.

Assuming we want to keep the Geography and the Type Faces unchanged, then all we really need is a deltas/differences package that can be used to offer a solution based on the concept of supplying the original CSS whole, and then toggle into dark with only the deltas.

So, I set out into the code to strip out only the color elements - but run into three problems.

1.  How would I compile it?  (Remember that I did not want to modify the core code.)  The answer was to create a `_variables-dark.scss`, with only the color items in it.
2.  and, Initially I just took all the variables and added a `-dark` suffix ... until I got to `.table-dark` ... ummm ... `.table-dark-dark` ... nope.
3.  ... also, was `-dark` appropriate?  What if, in third party theming, the primary color was dark, and that the prefers-color-scheme optioned to light. Ah... that brings me to another philosophy point.

The [specification][2] allows for three options: `no-preference`, `light` & `dark`.  Three options - but the choice is binary: either `light` or `dark` - so what's the other one (`no-preference`) all about then?  Well this one hands the preference over to the website author, allowing them to adopt their own preference.  Naturally this would be brand based or some other definition, whatever, the point is that the website author will have a default position of their own, also binary `light` or `dark`. This also applies to browsers that don't support color-scheme preference.


| user wants &rarr;<br>website has &darr; | *(not supported)* | no-preference | light |dark |
|:--:|:--:|:--:|:--:|:--:|
| __light__ | light | light | light | dark |
| __dark__ | dark | dark | light | dark |

&nbsp;

If you simplify the logic above table you get a binary option, for the website author.
1. Default render a light page, with a dark delta override, but only if the user browser preferences a dark color-scheme
2. Default render a dark page, with a light delta override, but only if the user browser preferences a light color-scheme

Key takeaway is that the alternative color (or the deltas) could be light, and the main / default / fallback color black.

This proof of concept would attempt to prove that light default (because Bootstrap 4's default is light) and dark deltas was possible.  No attempt was made to offer a dark main + light deltas as the proof would be evident in the PoC and this was/is not an attempt to offer a usable resource (more a learning one).

The question of compiling was easy enough to resolve; while I was extracting all the color variables, I needed to test the color combination - but all the Bootstrap code wasn't written for `*-alt` variables, so I had to map them back.  Another file `_variables-map-back.scss` thus maps back the `*-alt` to non-alt.  e.g. `$body-bg-alt: #000 !default;` and then `$body-bg: $body-bg-alt;`.   Unintentionally I'd created a whole dark theme.  I called it `bootstrap-night.scss`.  (More [on that](#bootstrap-night) later.)

The next phase was to look at how to use this new `*-alt` variables inside the core code... answer: I could not.


## The `*-alt` SCSS includes

Contributor [@ntkme][104] weighed in on [Issue #27514][26] and offered 4 ideas:

1.  Option 1: Wrap all Bootstrap code, twice over: one as normal, unfiltered, and then a second time with a `@media (prefers-color-scheme: dark) {}` query.
2.  Option 2: Drop `.*-dark` classes everywhere.
3.  Option 3: Support a build with different colors that's optimized for dark mode in two independent stylesheets
4.  Option 4: Fully switch to CSS variables

I pondered these - and (in my mind) responded&sup1;:

1.  Option 1: Great idea! Except ... all of Bootstrap?  Seems wasteful since the only things changing is the colors.
2.  Option 2: Oh No, oh no no no.  And how would the HTML look like???  Oh my... JS to enumerate all classes and add ‘-dark' to the class names.
3.  Option 3: Brilliant idea! Use [@Carl-Hugo][103]'s theme, and then instead of loading light as unfiltered and dark as a prefers-dark use [@tomayac][102]‘s two CSS with JS fallback.  Works just fine (except the considerations already mentioned).  Just needed a working example.
4.  Option 4: The work required to do this would be no more and no less than what I'd already done in creating the `*-alt` set ... except I was concerned with browser support (as already mentioned).

But [@ntkme][104] seeded an idea and this is where I excel at - taking other's seeds and growing them (thought-wise that is).

And so, I set out to build 4 variants of "dark mode" support, namely:

1.  **`bootstrap-night.scss`** - this one (as already mentioned) was created accidently in testing the color combination - but I also wanted to build a working prototype - this is after all a proof of concept.  So, I'd prove this works.  It also shows [@tomayac][102]'s work beeing applied to Bootstrap.
2.  **`bootstrap-nightfall.scss`** - this one was seeded from [@ntkme][104]'s Option 3 ... but instead of doubling up on the CSS, the alternative add-on would only contain the deltas/differences.
3.  **`bootstrap-nightshade.scss`** - this one was seeded from [@ntkme][104]'s Option 2 ... but with one major difference.  Instead of adding `-dark` to each CSS element just create one over-arching `dark` class on the `<html>` tag.  Then the CSS would have `html.dark xxx {}` selectors, again only for the deltas.  Plus, I needed to prove the CSS would work by writing some JS to toggle the `dark` class in and out as the user changes preference with a listener.
4.  **`bootstrap-dark.scss`** - the grail stylesheet - this one was seeded from [@ntkme][104]'s Option 1; traditional Bootstrap with a `@media (prefers-color-scheme: dark) {}` query that would present only the deltas in one self-contained, easily ported, no additional JS, solution. The perfect solution, albeit without the flexibility of the Bootstrap-Night example.

(Mind you; I named these after the fact.)  Anyway ... No. 1 was already built, but No's. 2, 3 & 4 had something in common: The deltas.  I needed to build the deltas without modifying the core code.  Painstakingly I copied each scss include and edited all the non-color elements out and then also pointed all the color elements to their `*-alt` variables.  3 days later it was done.  Thankfully I did not encounter the snag I did when I attempted to dark-mode-alize Foundation - where I found several instances where color was coded directly into the includes and even the mixins.  This made it that I would have to in essence duplicate the majority of Foundation 6 SCSS and then edit out hard coded colors and replace with SCSS variables - sure doable, but next version updates to the core would require a redo and I was just not up for that.  The other irritation of F6 was the SCSS var like `$white` were littered everywhere - so in making dark variants for Foundswatch the var $white are contain black CSS colors and visa-a-versa.  Sure, workable but confusing as hell.

I did however come across one mixin that needed to be re-done, `_forms.scss`, where the `color`, `background-color`, `border-color` and `box-shadow` where all coded in using non-alt SCSS variables, so needed to create a ` form-control-focus-alt` mixin that then used the `*-alt` vars, and then find where `form-control-focus` was called and change that too.  I also needed to re-do the `_functions.scss` file with `color-yiq-alt`, `color-alt`, `theme-color-alt`, `gray-alt` & `theme-color-level-alt` function using the `*-alt` vars. Not a biggie.

The end result was that I now had a set of SCSS includes that when compiled offered me a deltas package that I could use in all three remaining variants.  That and the map-back functionality I mentioned meant 4 very different ways of producing the same color combinations.


## The Variants

### Bootstrap-Night

[`bootstrap-night`][91] is a stand-alone CSS that is essentially just a themed version of Bootstrap.  One can use it as stand-alone theme, similar to all the themes on [Bootswatch][27], but since it is in essence exactly the same as default Bootstrap (in terms of styling sans color) it can be used as an alternative light/dark combination with the original default theme.

The essence of this code is simple:  Use two fully themed copies of Bootstrap, one light and one dark.  Each `<link rel="stylesheet"` would have different media type attributes, leveraging the `prefers-color-scheme` filter.

To do this use the following code:

```html
<!-- Bootstrap CSS -->
<!-- Inform modern browsers that this page supports both dark and light color schemes,
  and the page author prefers light. -->
<meta name="color-scheme" content="light dark">
<script>
  // If `prefers-color-scheme` is not supported, but @media query is, fall back to light mode.
  // i.e. In this case, inject the `light` CSS before the others, with
  // no media filter so that it will be downloaded with highest priority.
  if (window.matchMedia("(prefers-color-scheme: dark)").media === "not all") {
    document.documentElement.style.display = "none";
    document.head.insertAdjacentHTML(
      "beforeend",
      "<link rel=\"stylesheet\" href=\"bootstrap.css\" onload=\"document.documentElement.style.display = ''\">"
    );
  }
</script>
<!-- Load the alternate CSS first ... -->
<link rel="stylesheet" href="bootstrap-night.css" media="(prefers-color-scheme: dark)">
<!-- ... and then the primary CSS last for a fallback on very old browsers that don't support media filtering -->
<link rel="stylesheet" href="bootstrap.css" media="(prefers-color-scheme: no-preference), (prefers-color-scheme: light)">
```

The first `<meta name="color-scheme" ...>` assists the browser in rendering the page background with the desired color scheme immediately. Thomas Steiner ([@tomayac][102]) discusses this in his article [*"Improved dark mode default styling with the color-scheme CSS property and the corresponding meta tag"*][28].

The `<script>` bit adds a bit of JavaScript that will inject the default (light) CSS into the html header with no media filter before the other two stylesheet declarations.  This will force the browser to load the default CSS at the highest priority.  Read Thomas Steiner's ([@tomayac][102]) [*"Hello Darkness"*][14] article on that.


### Bootstrap-Nightfall


The basic premise of [`bootstrap-nightfall`][92] is that it's built as a Bootstrap add-on.  (Where the principle of "[add-on](https://www.lexico.com/en/definition/add-on)" is an additional functionality requiring the original Bootstrap to be in use and then the add-on adds or modifies functionality and/or UI.)

In essence it can be used in a pure add-on mode to override Bootstrap color styling to give you a dark only theme.

```html
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="bootstrap.css">
<!-- Boostrap add-on -->
<link rel="stylesheet" href="bootstrap-nightfall.css">
```

But, knowing what we do about the `media="(prefers-color-scheme: dark)"` filter we can amend the header and include `bootstrap-nightfall` as a "*dark scheme only*" add-on.

```html
<!-- Bootstrap CSS -->
<!-- Inform modern browsers that this page supports both dark and light color schemes,
  and the page author prefers light. -->
<meta name="color-scheme" content="light dark">
<!-- Load the primary CSS first ... -->
<link rel="stylesheet" href="bootstrap.css">
<!-- ... and then the alternate CSS first as a snap-on for dark color scheme preference -->
<link rel="stylesheet" href="bootstrap-nightfall.css" media="(prefers-color-scheme: dark)">
```

There is however one significant draw back that makes this option not feasible&sup1;!  The dreaded **[FOUC][29]**!  Well - technically it is not a full "Flash Of Unstyled Content", and I'm only getting it in FireFox 76 (at the time I wrote this), but Safari and Chrome don't flash.  By "flash" I mean that when the user is in dark-mode and the page loads, it shows the light scheme first, for a sub second, and then transitions to dark.  This sub-second motion looks like a flash... each and every page... that I find super annoying.

There are techniques that can be used to remove the FOUC, but I personally don't like this approach and will not address this problem.  It is after all a Proof of Concept, and the intent is to prove that this methodology works, not that it's a viable.


### Bootstrap-Nightshade

Initially when I set out on this PoC I did not intend to create [`bootstrap-nightshade`][93].  The principle behind being that dark mode could be driven by the addition of a class in the content that would define light / dark UI and some underlying code to allow a user to toggle that preference. But then I felt I needed to address the toggle button question and this methodology seemed the best to illustrate that (more on [the toggle switch](#the-toggle-switch) later).

The construction of the CSS file starts with the inclusion of all of the default Bootstrap, and then an inclusion of the deltas in a nested SCSS selector, like so:

```scss
@import x;  //** all of bootstrap **

html.dark {
  @import y;  //** all `*-alt` color stuff, a.k.a. deltas **
}
```

And so, with this one file one can just replace the Bootstrap CSS with the `bootstrap-nightshade` CSS.

```html
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="bootstrap-nightshade.css">
```

However, by itself, this will do nothing as the underlying Bootstrap original is active by default.  To toggle over to the dark variant one needs to write some JavaScript to trigger this transition.  (*On a side note:* There is a large body of recommendations to remove Bootstrap's dependency on jQuery - specifically those wishing to use it in React, AngularJS or Vue.js - but this PoC is based only on version 4.5.0 of Bootstrap, that is dependent on jQuery, so I've coded this toggle requiring jQuery.)  The following code is used to toggle a `dark` class in the `<html>` tag:

```js
<script>
  $(document).ready(function(){

    // function to toggle the css
    function toggle_color_scheme_css () {
      // get the current mode
      $mode = (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) ? 'dark' : 'light';
      // amend the html classes
      if ($mode == 'dark') {
        $("html").removeClass('light').addClass("dark");
      } else {
        $("html").removeClass("dark").addClass('light');
      }
    }

    // initial mode discovery & update button
    toggle_color_scheme_css();

    // update every time it changes
    if (window.matchMedia)
      window.matchMedia("(prefers-color-scheme: dark)").addListener( toggle_color_scheme_css );

  });
</script>
```

Why the `<html>` tag and not the `<body>` tag is covered by Geoff Graham in [*"HTML vs Body in CSS"*][30].

Of significant consideration here is that the dreaded **[FOUC][29]** is back - on all browsers!  This is because the code is only executed once jQuery loads, thus the page already rendered, and the flash will most certainly occur when the user preferences a dark mode.

#### The toggle switch

As I was researching this, I came across a myriad of content describing the philosophy and how-to of getting a toggle switch going and it <u>seemed</u> to be the norm.  But the more I read the more I realized that these recommendations pre-date the advent of the `prefers-color-scheme` media query.  Even more recent content, like Chris Coyier's [*"Let's Say You Were Going to Write a Blog Post About Dark Mode"*][31] recommends that *"Dark Mode could (should?) be a choice on the website as well"* suggesting that even though one leverages the `prefers-color-scheme` because the user's browser specifically asked for it by specifically opting in to dark mode on his OS, or by browser theme (as Firefox has the option to) - that that user may want your site to be light.  Umm... I call [BS][33]&sup1; on that.  I just don't get&sup1; the philosophy of a user, at OS level, saying that they want everything they do on that platform to be dark - except on your website.  I don't even think it's a thing&sup1;, and unless I see a study showing how many users set dark mode preferences on OS level and then expect light on given websites - across many websites - I'm not buying into the toggle switch idea.  IMHO I think it's a legacy thought conjured up before `prefers-color-scheme` media query was adopted by the [W3C][2] - and that that thinking is no longer needed&sup1;.  (You don't see cars being pulled by horses anymore, do you?)  The only *"experts"* still peddling the toggle switch are yet to catch up with the feature set... I read one saying that he disagreed with Apple pushing its agenda on this (even though its standardized by the W3C, and adopted by Microsoft, Mozilla and Google), and another saying that his users demand it - then looked at his dark variant and wanted the light one too - only because that dark mode implementation could have been classified a sin&sup1;.  Developing dark mode websites needs specific thinking around supporting two color variants and there are several other considerations to account for other than CSS. (More on [that](#other-considerations) later.)

If you look at sites that use the `prefers-color-scheme` media query correctly - like [Twitter][34] and [StackOverflow][35] - there is no toggle switch.

Nevertheless - I myself used a toggle switch in some of the test pages ... but that was because I wanted to toggle between the Night theme and the default Bootstrap theme to see if the colors worked.  I never intended to develop a persistence layer for it.  But in the case of NightShade I pondered persistence and how that would play out in a scenario where the user OS and the user interaction were not aligned and how to handle it as a logic experiment.  So I prototyped it and it's code is viewable in the [test-nightshade][36] example.



### Bootstrap-Dark

[`bootstrap-dark`][94], is in my opinion the grail CSS&sup1;, the one I would use.  It can be used as a drop-in replacement for the original CSS.  No additional code, no additional add-ons, and works on all the supported browsers.

Internally the CSS is composed of all of the original Bootstrap and then a single `(prefers-color-scheme: dark)` media query.  Within that query would be all the color CSS elements, just in the alternate colors (deltas).

To use it, simply replace the Bootstrap CSS stylesheet:

```html
<!-- Inform the browser that this page supports both dark and light color schemes,
  and the page author prefers light. -->
<meta name="color-scheme" content="light dark">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="bootstrap-dark.css">
```

#### Utility classes

There are also a small set of utility classes imbedded in the `bootstrap-dark` CSS.

##### Display

Use the `d-light-*` and `d-dark-*` classes to isolate parts of your site to only display on certain color-scheme modes, like this:

```html
<!-- this will only display in light mode, and only on browsers that support it -->
<span class="d-none d-light-inline">Try this website on dark mode.</span>
<!-- this will only display in dark mode -->
<span class="d-none d-dark-inline">Thank you for saving your eyes in dark mode.</span>
```

You can also use these to display when not on certain color-scheme modes, like this:

```html
<!-- this will only display in browsers that do not support `prefers-color-scheme` -->
<span class="d-no-preference-none d-dark-none d-light-none">Your browser is old!</span>
```

##### Images

This variant also contains an additional import file `_dark.scss` that adds the following:

```scss
img {
  opacity: .75;
  transition: opacity .5s ease-in-out;
  &:hover {
    opacity: 1;
  }
}
```

To understand the thinking behind this code read [@mdo][100]'s blog entry [*"CSS dark mode"*][37].

#### SCSS mixin's and variables

I mentioned all the [`*-alt` variables](#the--alt-scss-includes) earlier, but there are two more entities worth a mention:

1.  The `$color-scheme-alt` variable in the `_variables-alt.scss` class sets the alternate color mode.  This can be one of `light` or `dark`.  If you're a theme builder and your theme is primarily dark, then set this to `light` and populate all the `*-alt` variables with your light color selections.
2.  The `prefers-color-scheme` mixin.  This mixin creates the media filter based on your selection.  It’s only parameter is the color mode, which can be one of:  `no-preference`, `light` or `dark`.  If you're building custom elements or additional CSS you can use this in SCSS like this:

```scss
.my-mighty-widget {
  color: red;
}
@include prefers-color-scheme(dark) {
  .my-mighty-widget {
    color: blue;
  }
}
```




---
<p align="center" style="text-align:center;display:block;font-size:75%">&copy; 2020</p>


[1]: https://en.wikipedia.org/wiki/Theory_of_multiple_intelligences#Verbal-linguistic
[2]: https://www.w3.org/TR/mediaqueries-5/#prefers-color-scheme
[3]: https://github.com/vinorodrigues/wp-bootstrap4
[4]: https://github.com/vinorodrigues/wp-bootstrap2
[5]: https://github.com/vinorodrigues/print-ready
[6]: https://trac.webkit.org/changeset/237156/webkit
[7]: https://github.com/twbs/bootstrap/issues/27514
[8]: https://bootswatch.com
[9]: https://github.com/thomaspark/bootswatch/
[10]: https://github.com/justinmahar/foundswatch
[11]: https://github.com/vinorodrigues/foundswatch
[12]: https://bootswatch.com/flatly/
[13]: https://bootswatch.com/darkly/
[14]: https://web.dev/prefers-color-scheme/
[15]: https://foundswatch.com/themes/dark/
[16]: https://foundswatch.com/help/#dark-mode
[17]: https://github.com/ForEvolve/bootstrap-dark
[18]: https://en.wikipedia.org/wiki/Light-on-dark_color_scheme
[19]: https://uxdesign.cc/the-past-present-and-future-of-dark-mode-9254f2956ec7
[20]: https://www.wired.co.uk/article/google-chrome-dark-mode-design
[21]: https://mashable.com/article/dark-mode-apps-instagram-google-chrome-apple-ios13/
[22]: https://blog.weekdone.com/why-you-should-switch-on-dark-mode/
[23]: https://www.androidauthority.com/dark-mode-1046425/
[23]: https://caniuse.com/#feat=prefers-color-scheme
[24]: https://caniuse.com/#feat=css-variables
[25]: https://www.w3counter.com/globalstats.php?year=2020&month=4
[26]: https://github.com/twbs/bootstrap/issues/27514#issuecomment-508972071
[27]: https://bootswatch.com
[28]: https://web.dev/color-scheme/
[29]: https://en.wikipedia.org/wiki/Flash_of_unstyled_content
[30]: https://css-tricks.com/html-vs-body-in-css/
[31]: https://css-tricks.com/lets-say-you-were-going-to-write-a-blog-post-about-dark-mode/
[32]: https://en.wikipedia.org/wiki/Usage_share_of_web_browsers
[33]: https://www.amazon.com/Bullshit-Harry-G-Frankfurt-ebook/dp/B001EQ4OJW
[34]: https://twitter.com/mdo
[35]: https://stackoverflow.com/users/1575941/vino
[36]: https://vinorodrigues.github.io/bootstrap-dark/test-nightshade.html
[37]: https://markdotto.com/2018/11/05/css-dark-mode/
[xx]: https://en.wikipedia.org/wiki/Information_overload

[90]: https://github.com/vinorodrigues/bootstrap-dark
[91]: https://github.com/vinorodrigues/bootstrap-dark/blob/master/scss/bootstrap-night.scss
[92]: https://github.com/vinorodrigues/bootstrap-dark/blob/master/scss/bootstrap-nightfall.scss
[93]: https://github.com/vinorodrigues/bootstrap-dark/blob/master/scss/bootstrap-nightshade.scss
[94]: https://github.com/vinorodrigues/bootstrap-dark/blob/master/scss/bootstrap-dark.scss

[100]: https://github.com/mdo
[101]: https://github.com/thomaspark
[102]: https://github.com/tomayac
[103]: https://github.com/Carl-Hugo
[104]: https://github.com/ntkme
