# New Theme Handoff (for next folder)

Ovaj fajl sluzi kao brzi kontekst kada otvorimo novi folder teme u network-u.

## Kontekst

- Izvorna tema: `startuj-legalno`
- Cilj: nova tema za drugi site u WordPress network-u
- Pristup: kopirati celu temu, zatim izbaciti suvisno (safe cleanup)
- Dizajn baza ostaje ista:
  - boje
  - Bootstrap setup
  - fontovi
  - osnovni spacing i utility pattern

## Sta je vazno da ostane

- SCSS build workflow (`npm run watch`, `npm run build`)
- `bootstrap.scss` tokeni i breakpoint logika
- font fajlovi i `@font-face`
- osnovni `functions.php` setup i enqueue

## Sta cistimo prvo

1. Nepotrebne page template fajlove
2. Nepotrebne `global-templates/*` partiale
3. Nepotrebne `loop-templates/*` fajlove
4. Suvisne ACF options stranice i field zavisnosti u `functions.php`
5. Neiskoriscene SCSS partiale i njihove `@import` reference

## Pravilo ciscenja

- Prvo ukloniti reference (get_template_part, enqueue, include),
- zatim tek brisati fajlove.

Tako izbegavamo fatal error tokom tranzicije.

## Minimalni runtime smoke test posle svake faze

- home radi
- jedna staticka stranica radi
- single post radi
- header/footer bez warning-a
- CSS se build-uje bez greske

## Kada otvorimo novi folder

Krenuti ovim redom:

1. Update identity (`style.css`, `Text Domain`, `package.json` name)
2. Aktivirati temu samo na ciljnom network site-u
3. Napraviti listu screens/sekcija koje novi site koristi
4. Uraditi fazno ciscenje po prioritetu iznad

## Prompt koji mozes odmah dati agentu u novom folderu

`Ovo je kopija teme startuj-legalno za novi network sajt. Zelim fazno ciscenje suvisnih template-a i SCSS-a, bez diranja design tokena (boje/fontovi/bootstrap). Kreni od inventara fajlova i predlozi safe cleanup redosled, pa implementiraj po fazama uz smoke test posle svake faze.`

---

Napomena: detaljniji reuse dokument je u `NEW-THEME-REUSE-GUIDE.md`.
