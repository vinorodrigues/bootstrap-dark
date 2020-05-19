# The Definitive* Guide to Dark Mode in Bootstrap 4
A proof of concept / Longform whitepaper

## About me & The History that led here

Firstly, I’d like to state that I’m not a professional developer – I was from about 1988 to about ‘05, but that’s not what I do now.  I’m an Electrical Engineer who manages datacentres and their staff, and design UPS, HVAC and power systems … that’s my day job.  But I still love code.   I code as a hobby and everything I’ve coded since 2005 I’ve opensource… somewhere.  I’m also not a “graphics” or “artistic” person – I’ve no education in design, UI or UX – but I understand it’s basic concepts.  I’m also not a long form writer… I’m dyslexic and have a relatively low [Verbal-linguistic Intelligence][1] – so these ramblings may be hard to digest.  My apologies.

None of the content here is original; It’s based on logical combination of ideas from many great technology content producers, and I’ve tried to reference these when I can.  There is also a lot of personal opinions and my own ideas of code philosophy positions – these I will mark with an asterisk (*).

I can’t remember when I first came across the concept of “dark mode”; must have been sometime in late 2018 when I’d installed Safari Technology Preview and read some reference to the [`prefers-color-scheme`][2] *(still in draft with the W3C)*.  At the time I was attempting to write a (now abandoned) [WordPress theme][3] based on Bootstrap 4 after having written a [Bootstrap 2 based theme][4] a few years earlier, and a more recently [printing plugin][5] for Bootstrap 3.  I remember thinking that I would love to not only release a highly configurable WordPress theme, but one that supported this wonderful [css-dark-mode][6].  I can vaguely recall looking at the code and deciding “Yea, not doable. *” and started doing some research on the topic.  But at the time there wasn’t much.  I did however come across [issue 27514][7] in the Bootstrap GitHub repository, and also saw @mdo close it off.  My thoughts were that if the creator of Bootstrap was not keen on this then it would never happen * - so I promptly gave up on WP-Bootstrap-4 and moved on to other hobbies.

Time passed – I fell out of love with Bootstrap and took on a new mistress*, Foundation 6.  Spent a lot of time with it, but it is… different… lighter, easier to use because it is simpler, merged awesomely with “your own scss”; but it also doesn’t work so well with out-of-the-box inclusion into existing sites – especially if you want to theme it up a bit, and it’s not as flexible.  Bootstrap has Thomas Park’s [Bootswatch][8] (Why the hell is he not a contributor? *), that he’s [been maintaining][9] for over 6 years now.  But Foundation has nothing - yes Justin Mahar has started one called [Foundswatch][10] in 2018, but he archived that and relinquished the domain name.  The funny thing about Justin’s work is that I didn’t know of it until after I had created my own variant of [Foundswatch][11], but I digress.  The important takeaway of that side-story is that whilst I was working on it, I explored deeply the topic of Dark Mode again.  I realised that [Bootswatch Flatly][12] and [Bootswatch Darkly][13] are only different in color.  I also came across Thomas Steiner’s awesome article [prefers-color-scheme: Hello darkness, my old friend][14] and realised that I could offer a dark-mode option to Foundswatch users. And so, for Foundswatch, I created a [foundation-dark][15] theme that was usable as a two-color scheme CSS (albeit with 2 CSS files) for Foundation 6 and wrote a how to in the [help page][16].

Sadly, I was not satisfied – I wanted a 1 CSS files solution – and promptly started to modify my own fork of Foundation for Site.  OMG!  It was very near impossible!  (More on why later.). Then one recent day I get a notification on my RSS reader that Bootstrap 4.5.0 was out … “hello my old love” I thought and did the pulling and reading and the revisiting watched issues …


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
