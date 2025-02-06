<?php

namespace YuriZoom\MoonShineCurrency\Fields;

use Closure;
use MoonShine\Contracts\Fields\DefaultValueTypes\DefaultCanBeArray;
use MoonShine\Fields\Number;
use MoonShine\InputExtensions\InputExt;
use NumberFormatter;

class Currency extends Number implements DefaultCanBeArray
{
    protected string $view = 'moonshine-currency::fields.currency';

    protected ?string $locale = null;

    protected ?string $currencyColumn = null;

    protected ?string $currency = null;

    public function __construct(Closure|string|null $label = null, ?string $column = null, ?Closure $formatted = null)
    {
        parent::__construct($label, $column, $formatted);
    }

    public function locale(string $locale): static
    {
        $this->locale = $locale;

        return $this;
    }

    public function toRawValue(bool $withoutModify = false): mixed
    {
        return $this->value * 100;
    }

    public function getLocale(): string
    {
        return $this->locale ?? app()->getLocale();
    }

    public function currency(string $column): static
    {
        $this->currencyColumn = $column;
        $this->isGroup = true;

        return $this;
    }

    public function currencyColumn(): ?string
    {
        return $this->currencyColumn;
    }

    public function getCurrency(): string
    {
        return $this->currency ?? config('moonshine.currency.default');
    }

    public function getCurrencyIcon(): string
    {
        return $this->getCurrency();
    }

    public function getCurrencies(): array
    {
        return config('moonshine.currency.currencies', []);
    }

    public function resolveCurrencyFill(array $raw = [], mixed $casted = null): static
    {
        if ($this->isGroup()) {
            $this->currency = data_get($casted ?? $raw, $this->currencyColumn());
        } else {
            $this->extension(new InputExt($this->getCurrencyIcon()));
        }

        return $this;
    }

    public function resolveFill(array $raw = [], mixed $casted = null, int $index = 0): static
    {
        $this->resolveCurrencyFill($raw, $casted);

        return parent::resolveFill($raw, $casted, $index);
    }

    protected function resolvePreview(): string
    {
        return (new NumberFormatter(
            $this->getLocale(), NumberFormatter::CURRENCY
        ))->formatCurrency(
            $this->toFormattedValue() / 100,
            $this->getCurrency(),
        );
    }

    protected function resolveValue(): float
    {
        return round($this->value / 100, 2);
    }

    protected function resolveOnApply(): ?Closure
    {
        return function ($item) {

            $values = $this->requestValue();

            if ($values === false) {
                return $item;
            }

            if ($this->isGroup()) {
                data_set($item, $this->column(), ($values[$this->column()] ?? 0) * 100);
                data_set($item, $this->currencyColumn(), $values[$this->currencyColumn()] ?? '');
            } else {
                data_set($item, $this->column(), $values * 100);
            }

            return $item;
        };
    }
}
