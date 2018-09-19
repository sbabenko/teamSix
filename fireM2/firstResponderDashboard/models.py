from django.db import models
from django.urls import reverse #Used to generate URLs by reversing the URL patterns

class incomingEvent(models.Model):
    """Model representing an incoming call for service"""
    location = models.CharField(max_length=200, help_text='Coordinates for incoming service event')
    serviceType = models.CharField(max_length=200, help_text='Description of service needed')
    urgency = models.CharField(max_length=200, help_text='Urgency level of situation')
    time = models.CharField(max_length=200, help_text='Time the event came in')

    class Meta:
        ordering = [''] #figure out how to sort by urgency, and then oldest (get most urgent events first, then sort by oldest?)

    def __str__(self):
        """String for representing the Model object."""
        return self.urgency

    def get_absolute_url(self):
        """Returns the url to access a particular event instance."""
        return reverse('', args=[str(self.id)])