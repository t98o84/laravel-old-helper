<?php

use Illuminate\Support\Facades\Session;

beforeEach(function () {
    $this->old = new class
    {
        public function set($key, $value): void
        {
            Session::flash("_old_input.$key", $value);
        }

        public function get($key, $default = null)
        {
            return Session::getOldInput($key, $default);
        }
    };
});

it('can get old value', function () {
    $this->old->set('name', 'Jane');

    expect($this->old->get('name'))->toBe('Jane');
});

describe('old str', function () {
    it('can get old string', function ($value) {
        $this->old->set('value', $value);

        expect(old_str('value'))->toBe($value);
    })->with([
        'Value',
    ]);

    it('can get old string with default', function () {
        expect(old_str('value', 'DefaultValue'))->toBe('DefaultValue');
    });

    it('can get null with default when not string', function ($value) {
        $this->old->set('value', $value);
        expect(old_str('value'))->toBeNull();
    })->with([
        1,
        1.1,
        true,
        [['Value']],
    ]);
});

describe('old num', function () {
    it('can get old num', function ($value, $expected) {
        $this->old->set('value', $value);

        expect(old_num('value'))->toBe($expected);
    })->with([
        [1, 1],
        ['1', 1],
        [1.1, 1.1],
        ['1.1', 1.1],
    ]);

    it('can get old num with default', function () {
        expect(old_num('value', 2))->toBe(2);
    });

    it('can get null with default when not num', function ($value) {
        $this->old->set('value', $value);
        expect(old_num('value'))->toBeNull();
    })->with([
        'Value',
        true,
        [['Value']],
    ]);
});

describe('old int', function () {
    it('can get old int', function ($value, $expected) {
        $this->old->set('value', $value);

        expect(old_int('value'))->toBe($expected);
    })->with([
        [1, 1],
        ['1', 1],
    ]);

    it('can get old int with default', function () {
        expect(old_int('value', 2))->toBe(2);
    });

    it('can get null with default when not int', function ($value) {
        $this->old->set('value', $value);
        expect(old_int('value'))->toBeNull();
    })->with([
        1.1,
        '1.1',
        true,
        [['Value']],
    ]);
});

describe('old float', function () {
    it('can get old float', function ($value, $expected) {
        $this->old->set('value', $value);

        expect(old_float('value'))->toBe($expected);
    })->with([
        [1.1, 1.1],
        ['1.1', 1.1],
    ]);

    it('can get old float with default', function () {
        expect(old_float('value', 2.2))->toBe(2.2);
    });

    it('can get null with default when not float', function ($value) {
        $this->old->set('value', $value);
        expect(old_float('value'))->toBeNull();
    })->with([
        1,
        '1',
        true,
        [['Value']],
    ]);
});

describe('old bool', function () {
    it('can get old bool', function ($value, $expected) {
        $this->old->set('value', $value);

        expect(old_bool('value'))->toBe($expected);
    })->with([
        [true, true],
        ['true', true],
        [1, true],
        ['1', true],
        [false, false],
        ['false', false],
        [0, false],
        ['0', false],
    ]);

    it('can get old bool with default', function () {
        expect(old_bool('value', true))->toBe(true);
    });

    it('can get null with default when not bool', function ($value) {
        $this->old->set('value', $value);
        expect(old_bool('value'))->toBeNull();
    })->with([
        1.1,
        '1.1',
        'Value',
        [['Value']],
    ]);
});

describe('old array', function () {
    it('can get old array', function ($value, $expected) {
        $this->old->set('value', $value);

        expect(old_array('value'))->toBe($expected);
    })->with([
        [['Value'], ['Value']],
    ]);

    it('can get old array with default', function () {
        expect(old_array('value', ['DefaultValue']))->toBe(['DefaultValue']);
    });

    it('can get null with default when not array', function ($value) {
        $this->old->set('value', $value);
        expect(old_array('value'))->toBeNull();
    })->with([
        1.1,
        '1.1',
        true,
        'Value',
    ]);
});
