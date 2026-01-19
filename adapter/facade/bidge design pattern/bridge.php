<?php

// Bridge Design Pattern Example
// Decouples abstraction (Shape) from implementation (DrawingAPI)

// Implementation interface
interface DrawingAPI {
    public function drawCircle(float $x, float $y, float $radius): void;
    public function drawRectangle(float $x, float $y, float $width, float $height): void;
}

// Concrete Implementations
class DrawingAPI1 implements DrawingAPI {
    public function drawCircle(float $x, float $y, float $radius): void {
        echo "API1: Drawing circle at ($x, $y) with radius $radius\n";
    }

    public function drawRectangle(float $x, float $y, float $width, float $height): void {
        echo "API1: Drawing rectangle at ($x, $y) with width $width and height $height\n";
    }
}

class DrawingAPI2 implements DrawingAPI {
    public function drawCircle(float $x, float $y, float $radius): void {
        echo "API2: Drawing circle at ($x, $y) with radius $radius\n";
    }

    public function drawRectangle(float $x, float $y, float $width, float $height): void {
        echo "API2: Drawing rectangle at ($x, $y) with width $width and height $height\n";
    }
}

// Abstraction
abstract class Shape {
    protected DrawingAPI $drawingAPI;

    public function __construct(DrawingAPI $drawingAPI) {
        $this->drawingAPI = $drawingAPI;
    }

    abstract public function draw(): void;
    abstract public function resize(float $factor): void;
}

// Refined Abstractions
class CircleShape extends Shape {
    private float $x, $y, $radius;

    public function __construct(float $x, float $y, float $radius, DrawingAPI $drawingAPI) {
        parent::__construct($drawingAPI);
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public function draw(): void {
        $this->drawingAPI->drawCircle($this->x, $this->y, $this->radius);
    }

    public function resize(float $factor): void {
        $this->radius *= $factor;
    }
}

class RectangleShape extends Shape {
    private float $x, $y, $width, $height;

    public function __construct(float $x, float $y, float $width, float $height, DrawingAPI $drawingAPI) {
        parent::__construct($drawingAPI);
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
    }

    public function draw(): void {
        $this->drawingAPI->drawRectangle($this->x, $this->y, $this->width, $this->height);
    }

    public function resize(float $factor): void {
        $this->width *= $factor;
        $this->height *= $factor;
    }
}

// Usage
$api1 = new DrawingAPI1();
$api2 = new DrawingAPI2();

$circle1 = new CircleShape(1, 2, 3, $api1);
$circle2 = new CircleShape(5, 7, 11, $api2);

$rectangle1 = new RectangleShape(10, 20, 30, 40, $api1);
$rectangle2 = new RectangleShape(15, 25, 35, 45, $api2);

$shapes = [$circle1, $circle2, $rectangle1, $rectangle2];

foreach ($shapes as $shape) {
    $shape->draw();
}