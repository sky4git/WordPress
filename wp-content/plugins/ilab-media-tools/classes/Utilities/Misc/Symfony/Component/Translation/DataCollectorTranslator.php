<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Translation;

use ILAB\MediaCloud\Utilities\Misc\Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface;
use ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Translation\Exception\InvalidArgumentException;
/**
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 */
class DataCollectorTranslator implements \ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Translation\TranslatorInterface, \ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Translation\TranslatorBagInterface, \ILAB\MediaCloud\Utilities\Misc\Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface
{
    const MESSAGE_DEFINED = 0;
    const MESSAGE_MISSING = 1;
    const MESSAGE_EQUALS_FALLBACK = 2;
    /**
     * @var TranslatorInterface|TranslatorBagInterface
     */
    private $translator;
    private $messages = [];
    /**
     * @param TranslatorInterface $translator The translator must implement TranslatorBagInterface
     */
    public function __construct(\ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Translation\TranslatorInterface $translator)
    {
        if (!$translator instanceof \ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Translation\TranslatorBagInterface) {
            throw new \ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Translation\Exception\InvalidArgumentException(\sprintf('The Translator "%s" must implement TranslatorInterface and TranslatorBagInterface.', \get_class($translator)));
        }
        $this->translator = $translator;
    }
    /**
     * {@inheritdoc}
     */
    public function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        $trans = $this->translator->trans($id, $parameters, $domain, $locale);
        $this->collectMessage($locale, $domain, $id, $trans, $parameters);
        return $trans;
    }
    /**
     * {@inheritdoc}
     */
    public function transChoice($id, $number, array $parameters = [], $domain = null, $locale = null)
    {
        $trans = $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
        $this->collectMessage($locale, $domain, $id, $trans, $parameters, $number);
        return $trans;
    }
    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        $this->translator->setLocale($locale);
    }
    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->translator->getLocale();
    }
    /**
     * {@inheritdoc}
     */
    public function getCatalogue($locale = null)
    {
        return $this->translator->getCatalogue($locale);
    }
    /**
     * {@inheritdoc}
     */
    public function warmUp($cacheDir)
    {
        if ($this->translator instanceof \ILAB\MediaCloud\Utilities\Misc\Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface) {
            $this->translator->warmUp($cacheDir);
        }
    }
    /**
     * Gets the fallback locales.
     *
     * @return array The fallback locales
     */
    public function getFallbackLocales()
    {
        if ($this->translator instanceof \ILAB\MediaCloud\Utilities\Misc\Symfony\Component\Translation\Translator || \method_exists($this->translator, 'getFallbackLocales')) {
            return $this->translator->getFallbackLocales();
        }
        return [];
    }
    /**
     * Passes through all unknown calls onto the translator object.
     */
    public function __call($method, $args)
    {
        return \call_user_func_array([$this->translator, $method], $args);
    }
    /**
     * @return array
     */
    public function getCollectedMessages()
    {
        return $this->messages;
    }
    /**
     * @param string|null $locale
     * @param string|null $domain
     * @param string      $id
     * @param string      $translation
     * @param array|null  $parameters
     * @param int|null    $number
     */
    private function collectMessage($locale, $domain, $id, $translation, $parameters = [], $number = null)
    {
        if (null === $domain) {
            $domain = 'messages';
        }
        $id = (string) $id;
        $catalogue = $this->translator->getCatalogue($locale);
        $locale = $catalogue->getLocale();
        $fallbackLocale = null;
        if ($catalogue->defines($id, $domain)) {
            $state = self::MESSAGE_DEFINED;
        } elseif ($catalogue->has($id, $domain)) {
            $state = self::MESSAGE_EQUALS_FALLBACK;
            $fallbackCatalogue = $catalogue->getFallbackCatalogue();
            while ($fallbackCatalogue) {
                if ($fallbackCatalogue->defines($id, $domain)) {
                    $fallbackLocale = $fallbackCatalogue->getLocale();
                    break;
                }
                $fallbackCatalogue = $fallbackCatalogue->getFallbackCatalogue();
            }
        } else {
            $state = self::MESSAGE_MISSING;
        }
        $this->messages[] = ['locale' => $locale, 'fallbackLocale' => $fallbackLocale, 'domain' => $domain, 'id' => $id, 'translation' => $translation, 'parameters' => $parameters, 'transChoiceNumber' => $number, 'state' => $state];
    }
}
