# WARNINGS

In order to get around a massive issue that currently exists with asset mapper
and the fact that GraphIQL doesn't actually minimize its code, You will have to
manually edit one of the vendor files after doing a composer install.

`./vendor/api-platform/symfony/Bundle/Resources/public/graphiql/graphiql.min.js`

line 20633 has a comment section that looks something like:
```js
// Asynchronous loading
import { LazyMotion, m } from "framer-motion"

function App() {
  return (
    <LazyMotion features={() => import('./path/to/domAnimations')}>
      <m.div animate={{ scale: 2 }} />
    </LazyMotion>
  )
}
```

The `import` command is being picked up by asset mapper, even though its in a
docblock because they use regex to generate the importmap. This works great when
javascript developers actually issue minimised code, and works like total crap
otherwise. Change the word `import` to anything else. I went with `mimport`.

# Setup

```shell
# install php dependencies.
composer install

# create database
symfony console doctrine:database:create

# apply database schema migrations.
symfony console doctrine:migrations:migrate

```


# TODO items

- [ ] Document Mapper system.
- [ ] Document DTO convention.