from django.db import models

class incomingEvent(models.Model):
    """Model representing an incoming call for service"""
    location = models.CharField(max_length=200, help_text='Coordinates for incoming service event')
    serviceType = models.CharField(max_length=200, help_text='Description of service needed')
    urgency = models.CharField(max_length=200, help_text='Urgency level of situation')
    time = models.CharField(max_length=200, help_text='Time the event came in')

    class Meta:
        ordering = ['urgency'] #figure out how to sort by urgency, and then oldest (get most urgent events first, then sort by oldest?)

    def __str__(self):
        """String for representing the Model object."""
        return self.urgency

    def get_absolute_url(self):
        """Returns the url to access a particular event instance."""
        return reverse('', args=[str(self.id)])

class CallInstance(models.Model):
    """Model representing a specific Incoming Call."""
    
    imprint = models.CharField(max_length=200)
    due_back = models.DateField(null=True, blank=True)

    LOAN_STATUS = (
        ('m', 'Maintenance'),
        ('o', 'On loan'),
        ('a', 'Available'),
        ('r', 'Reserved'),
    )

    status = models.CharField(
        max_length=1,
        choices=LOAN_STATUS,
        blank=True,
        default='m',
        help_text='Book availability',
    )

    class Meta:
        ordering = ['due_back']

    def __str__(self):
        """String for representing the Model object."""
        return f'{self.id} ({self.book.title})'

class textInstance(models.Model):
    """Model representing a specific incoming text."""
    imprint = models.CharField(max_length=200)
    due_back = models.DateField(null=True, blank=True)

    LOAN_STATUS = (
        ('m', 'Maintenance'),
        ('o', 'On loan'),
        ('a', 'Available'),
        ('r', 'Reserved'),
    )

    status = models.CharField(
        max_length=1,
        choices=LOAN_STATUS,
        blank=True,
        default='m',
        help_text='Book availability',
    )

    class Meta:
        ordering = ['due_back']

    def __str__(self):
        """String for representing the Model object."""
        return f'{self.id} ({self.book.title})'
