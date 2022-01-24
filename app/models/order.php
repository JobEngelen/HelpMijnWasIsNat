<?
class Order
{
    private int $id;
    private string $username;
    private float $totalPrice;
    private string $order_date;
    private int $status;
    private $order_content = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getOrderDate(): string
    {
        return $this->order_date;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getOrderContent()
    {
        return $this->order_content;
    }

    public function setOrderContent(OrderContent $content)
    {
        $this->order_content[] = $content;
        return $this;
    }
}
